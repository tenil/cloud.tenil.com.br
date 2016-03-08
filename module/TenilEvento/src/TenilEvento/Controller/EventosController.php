<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 03/06/2015
 * Time: 14:27
 */

namespace TenilEvento\Controller;

use TenilEvento\Entity\Inscricao;
use TenilEvento\Form\InscricaoCreate;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use TenilBase\Controller\CrudController;

class EventosController extends CrudController
{

    public function __construct()
    {
        $this->controller = 'eventos';
        $this->entity = 'TenilEvento\Entity\Evento';
        $this->form = 'TenilEvento\Form\EventoCreate';
        $this->route = 'tenil-evento';
        $this->service = 'TenilEvento\Service\Evento';
    }


    /**
     * @return ViewModel
     */
    public function detailAction()
    {
        $id = $this->params()->fromRoute('id', null);
        //$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        // $evento = $em->getRepository('TenilEvento\Entity\Evento')->find($id);
        $data = $this->getEm()->getRepository($this->entity)->findOneBy(array('slug' => $id));

        if ($data) {
            return new ViewModel(array('data' => $data));
        } else {
            return $this->notFoundAction();
        }

    }


    public function signupAction()
    {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $form = new InscricaoCreate($objectManager);

        $id = $this->params()->fromRoute('id', null);

        $evento = $this->getEm()->getRepository($this->entity)->findOneBy(array('slug' => $id));

        if ($evento) {

            $inscricao = new Inscricao();
            $inscricao->setEvento($evento);

            $form->bind($inscricao);

            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());

                if ($form->isValid()) {
                    $objectManager->persist($inscricao);
                    $objectManager->flush();

                    $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Cadastro realizado com sucesso!');
                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'list'));

                } else {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage('Preencha todos os valores corretamente!');
                }

            }

            return new ViewModel(array('form' => $form, 'data' => $evento));
        } else {
            return $this->notFoundAction();
        }

    }

}