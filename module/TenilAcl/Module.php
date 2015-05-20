<?php

namespace TenilAcl;

use Zend\Authentication\Storage\Session;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        /** @var \Zend\ModuleManager\ModuleManager $moduleManager */
        $moduleManager = $e->getApplication()->getServiceManager()->get('modulemanager');
        /** @var \Zend\EventManager\SharedEventManager $sharedEvents */
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        //adiciona eventos ao módulo
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', MvcEvent::EVENT_DISPATCH, array($this, 'mvcPreDispatch'), 100);
    }

    /**
     * Verifica a autorização do acesso
     * @param MvcEvent $event Evento
     * @return boolean
     * @throws \Exception Acesso negado
     */
    public function mvcPreDispatch($event)
    {
        $di = $event->getTarget()->getServiceLocator();
        $routeMatch = $event->getRouteMatch();
        $routeName = $routeMatch->getMatchedRouteName();
        $moduleName = $routeMatch->getParam('module');
        $controllerName = $routeMatch->getParam('controller');
        $actionName = $routeMatch->getParam('action');


        $authService = $di->get('TenilUser\Service\Auth');

        /*
        if (!$authService->authorize($moduleName, $controllerName, $actionName)) {
            throw new \Exception('Você não tem permissão para acessar este recurso.');
        }
*/
        return true;
    }

    /**
     * @description Authorisation (Make sure users are logged in before allowing them to see anything)
     * @param MvcEvent $e
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function authPreDispatch(MvcEvent $e)
    {

        $matches = $e->getRouteMatch();

        if (!$matches instanceof RouteMatch) {
            return false;
        }

        $controller = $matches->getParam('controller');

        $app = $e->getApplication();
        $serviceManager = $app->getServiceManager();

        $auth = $serviceManager->get('TenilUser\Service\Auth');
        if (!$auth->hasIdentity() && $controller != 'TenilUser\Controller\Auth') {
            $router = $e->getRouter();
            $url = $router->assemble(array(), array('name' => 'login'));

            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);

            return $response;
        }

        return false;
    }


    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Session' => function () {
                    return new Container('tenil');
                },
                'TenilAcl\Acl\Builder' => function () {
                    return new Acl\Builder;
                },
                'TenilAcl\Service\Role' => function ($sm) {
                    return new Service\Role($sm->get('Doctrine\ORM\EntityManager'));
                },
                'TenilAcl\Service\Resource' => function ($sm) {
                    return new Service\Resource($sm->get('Doctrine\ORM\EntityManager'));
                },
                'TenilAcl\Service\Privilege' => function ($sm) {
                    return new Service\Privilege($sm->get('Doctrine\ORM\EntityManager'));
                },
                'TenilAcl\Form\Role' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repositorio = $em->getRepository('TenilAcl\Entity\Role');
                    $parent = $repositorio->fetchParent();
                    return new Form\Role('role', NULL, $parent);
                },
                'TenilAcl\Form\Privilege' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');

                    $roleRepository = $em->getRepository('TenilAcl\Entity\Role');
                    $role = $roleRepository->fetchParent();

                    $resourceRepository = $em->getRepository('TenilAcl\Entity\Resource');
                    $resource = $resourceRepository->fetchPairs();

                    return new Form\Privilege('privilege', NULL, $role, $resource);
                },
                'TenilAcl\Permissions\Acl' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');

                    $roleRepository = $em->getRepository('TenilAcl\Entity\Role');
                    $roles = $roleRepository->findAll();

                    $resourceRepository = $em->getRepository('TenilAcl\Entity\Resource');
                    $resources = $resourceRepository->findAll();

                    $privilegeRepository = $em->getRepository('TenilAcl\Entity\Privilege');
                    $privileges = $privilegeRepository->findAll();

                    return new Permissions\Acl($roles, $resources, $privileges);
                }
            )
        );
    }
}
