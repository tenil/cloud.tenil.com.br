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
        $paginator->setCurrentPageNumber($pageNumber)
                ->setDefaultItemCountPerPage($count);
        
        return new ViewModel(array('data'=>$paginator, 'page'=>$page));
        
    }

}
