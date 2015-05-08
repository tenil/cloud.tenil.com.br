<?php

namespace TenilAcl\Controller;

use TenilBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class RolesController extends CrudController {

    public function __construct() {
        $this->entity = 'TenilAcl\Entity\Role';
        $this->service = 'TenilAcl\Service\Role';
        $this->form = 'TenilAcl\Form\Role';
        $this->controller = 'roles';
        $this->route = 'tenil-acl-admin/default';
    }
    
    public function addAction() {

        $form = $this->getServiceLocator()->get($this->form);
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
    
    public function editAction() {

        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        
        if($this->params()->fromRoute('id', 0)){
            $form->setData($entity->toArray());
        }
        
        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());

                $this->flashMessenger()->setNamespace('TenilUser')->addSuccessMessage('Atualizado com sucesso!');

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $form));

    }

    public function testAction() {
        
        $acl = $this->getServiceLocator()->get('TenilAcl\Permissions\Acl');
        
        echo $acl->isAllowed("Administrador de Usuários", "Área Administrativa de Usuários", "Editar") ? "Permitido" : "Negado" ; 
        
        die;

    }

}
