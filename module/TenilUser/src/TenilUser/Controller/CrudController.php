<?php

namespace TenilUser\Controller;

/**
 * Description of CrudController
 *
 * @author Roberto
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

abstract class CrudController extends AbstractActionController {

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
    protected function getEm() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;
    }

    public function indexAction() {

        $list = $this->getEm()
                ->getRepository($this->entity)
                ->findAll();

        $pageNumber = $this->params()->fromRoute('page');
        $count = 5;

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($pageNumber)->setDefaultItemCountPerPage($count)->set;

        return new ViewModel(array('data' => $paginator, 'page' => $pageNumber));
    }

    public function addAction() {

        $form = new $this->form();
        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());

              //  return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
        
    }

}
