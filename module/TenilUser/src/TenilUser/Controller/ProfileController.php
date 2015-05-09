<?php

namespace TenilUser\Controller;

use Zend\View\Model\ViewModel;

class ProfileController extends CrudController {

    public function __construct() {

        $this->entity = 'TenilUser\Entity\Perfil';
        $this->form = 'TenilUser\Form\Perfil';
        $this->service = 'TenilUser\Service\Perfil';
        $this->controller = 'profile';
        $this->route = 'tenil-user/default';
    }

    protected $em; //
    protected $user;

    public function getAuthService() {
        return $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    }

    public function indexAction() {

        $loggedUser = $this->getAuthService()->getIdentity();

        $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $perfil = $this->em->getRepository($this->entity)->find($loggedUser->getId());

        return new ViewModel(array('perfil' => $perfil));

    }

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

    public function editAction() {

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
