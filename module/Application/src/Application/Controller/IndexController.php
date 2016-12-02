<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class IndexController extends AbstractActionController
{

    private $em;

    public function indexAction()
    {

        // Em caso de redirecionamento:
        // return $this->redirect()->toRoute('tenil-evento');

        $list = $this->getEm()->getRepository('TenilEvento\Entity\Evento')->findAll();

        $pageNumber = $this->params()->fromRoute('page');
        $count = 5;

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($pageNumber)->setDefaultItemCountPerPage($count);

        $vm = new ViewModel(array('data' => $paginator, 'page' => $pageNumber));

        return $vm;

    }

    private function getEm()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;

    }

}
