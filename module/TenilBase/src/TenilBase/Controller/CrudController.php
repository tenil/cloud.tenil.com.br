<?php

namespace TenilBase\Controller;

/**
 * Description of CrudController
 *
 * @author Roberto
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

abstract class CrudController extends AbstractActionController
{

    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $route;
    protected $controller;

    /**
     *
     * @return EntityManager
     */
    protected function getEm()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;
    }

    public function indexAction()
    {

        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $pageNumber = $this->params()->fromRoute('page');
        $count = 10;

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($pageNumber)->setDefaultItemCountPerPage($count);

        return new ViewModel(array('data' => $paginator, 'page' => $pageNumber));
    }

    public function addAction()
    {

        $form = new $this->form();
        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());

                $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Cadastrado com sucesso!');

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $form));
    }

    public function editAction()
    {

        $form = new $this->form();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        //Teste muito sem vergonha
        if ($this->params()->fromRoute('id', 0)) {
            $data = $entity->toArray();
            unset($data['password']);
            $form->setData($data);
        }

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());

                $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Atualizado com sucesso!');

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $form));

    }

    public function deleteAction()
    {

        $service = $this->getServiceLocator()->get($this->service);
        if ($service->delete($this->params()->fromRoute('id', 0))) {
            $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Excluído com sucesso!');
        }

        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));

    }

    public function testeAction()
    {
        $data = array(
            'controller' => $this->controller,
            'entity' => $this->entity,
            'form' => $this->form,
            'route' => $this->route,
            'service' => $this->service
        );

        // $sl instanceof Zend\ServiceManager\ServiceManager

        $config = $this->getServiceLocator()->get('Config');
        $routes = $config['router']['routes'];

        return new ViewModel(array('data' => $data, 'routes' => $routes));
    }

    /**
     * @return ViewModel
     */
    public function listAction()
    {
//        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
//        $list = $em->getRepository('TenilEvento\Entity\Evento')->findAll();

        $list = $this->getEm()->getRepository($this->entity)->findAll();

        return new ViewModel(array('data' => $list));
    }


    public function createAction()
    {
        // Get ObjectManager from the ServiceManager
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        // Create the form and inject the ObjectManager
        $form = new $this->form($objectManager);

        // Create a new, empty entity and bind it to the form
        $entity = new $this->entity();

        $form->bind($entity);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $objectManager->persist($entity);
                $objectManager->flush();

                $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Cadastro realizado com sucesso!');
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'list'));
            }

        }

        return array('form' => $form);
    }

    public function getAuthService()
    {
        return $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    }
}