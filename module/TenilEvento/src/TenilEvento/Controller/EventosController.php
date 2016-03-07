<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 03/06/2015
 * Time: 14:27
 */

namespace TenilEvento\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use TenilBase\Controller\CrudController;

class EventosController extends CrudController
{

    public function __construct()
    {
        $this->controller   = 'eventos';
        $this->entity       = 'TenilEvento\Entity\Evento';
        $this->form         = 'TenilEvento\Form\EventoCreate';
        $this->route        = 'tenil-evento';
        $this->service      = 'TenilEvento\Service\Evento';
    }

    public function signupAction()
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

}