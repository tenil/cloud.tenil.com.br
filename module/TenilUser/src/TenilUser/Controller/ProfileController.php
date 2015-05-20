<?php

namespace TenilUser\Controller;

use TenilUser\Entity\Perfil;
use TenilUser\Form\PerfilCreate;
use TenilUser\Form\PerfilUpdate;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\View\Model\ViewModel;


class ProfileController extends CrudController
{

    public function __construct()
    {

        $this->entity = 'TenilUser\Entity\Perfil';
        $this->form = 'TenilUser\Form\Perfil';
        $this->service = 'TenilUser\Service\Perfil';
        $this->controller = 'profile';
        $this->route = 'perfil';
    }

    protected $em;
    protected $user;

    public function getAuthService()
    {
        return $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    }

    public function indexAction()
    {

        $authenticationService = $this->getAuthService();
        $perfil = $authenticationService->getIdentity()->getPerfil();

        return new ViewModel(array('perfil' => $perfil));

    }

    public function listAction()
    {
        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        return new ViewModel(array('data' => $list));

    }

    public function createAction()
    {
        // Get ObjectManager from the ServiceManager
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        // Create the form and inject the ObjectManager
        $form = new PerfilCreate($objectManager);

        // Create a new, empty entity and bind it to the form
        $perfil = new Perfil();
        $form->bind($perfil);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $objectManager->persist($perfil);
                $objectManager->flush();

                $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Prefil criado com sucesso!');
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'list'));
            }

        }

        return array('form' => $form);
    }

    public function updateAction()
    {

        // Verificar se existe parâmetro passado na rota
        //$id = (int)$this->params()->fromRoute('id', 0);

        $id = (int) $this->params('id');
        // Se não existe parâmetro, redirecionar para lista
        if (!$id) {
            return $this->redirect()->toRoute($this->route);
        }

        // Get your ObjectManager from the ServiceManager
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        // Create the form and inject the ObjectManager
        $form = new PerfilUpdate($objectManager);

        // Buscar dados na entidade and bind it to the form
        $perfil = $this->getEm()->find($this->entity, $id);
        $form->bind($perfil);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                // Save the changes
                $objectManager->flush();

                // Redirecionar para lista de perfis
                return $this->redirect()->toRoute(
                    $this->route,
                    array(
                        'controller' => $this->controller,
                        'action' => 'list')
                );

            }
        }

        return array(
            'form' => $form,
            'id' => $id,
        );
    }


    /*
        public function indexBkpAction() {

            $this->authService = new AuthenticationService;

            if ($this->getAuthService()->hasIdentity()) {
                $this->user = $this->getAuthService()->getIdentity();
            } else {
                $this->user = FALSE;

                return $this->redirect()->toRoute('home');
            }

            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

            $perfil = $this->em
                    ->getRepository($this->entity)
                    ->find($this->user->getId())
            //->getRepository('TenilUser\Entity\User')
            //->findOneBy(array('id' => 15))
            ;

            return new ViewModel(array('perfil' => $perfil));
        }
    */
    public function editAction()
    {

        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $this->user = $this->getAuthService()->getIdentity();
        $entity = $repository->find($this->user->getId());

        $data = $entity->toArray();
        $form->setData($data);

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $result = $service->update($request->getPost()->toArray());

                $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Usuário atualizado com sucesso!');

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $form));
    }
}
