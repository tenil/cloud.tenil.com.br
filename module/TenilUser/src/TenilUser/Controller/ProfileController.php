<?php

namespace TenilUser\Controller;

use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

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
    protected $authService;

    public function getAuthService() {
        return $this->authService;
    }

    public function indexAction() {

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

        /**
         * @todo Aprimorar edição, o usuário deve estar logado
         * @todo O id do usuário deve ser o mesmo do usuário logado
         *
         */

        /**
         * @todo Essa parte deverá ser resolvida pela ACL
         */

        $this->authService = new AuthenticationService;

        if ($this->getAuthService()->hasIdentity()) {
            $this->user = $this->getAuthService()->getIdentity();
        } else {
            $this->user = FALSE;

            $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Seção expirada!');
            return $this->redirect()->toRoute('home');
        }

        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();


        $repository = $this->getEm()->getRepository($this->entity);
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
