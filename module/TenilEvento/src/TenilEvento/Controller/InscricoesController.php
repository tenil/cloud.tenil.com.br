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

class InscricoesController extends AbstractActionController
{

    /**
     * @return ViewModel
     */
    public function listAction()
    {
        /**
         * Lista eventos em que a pessoa fez inscrição
         */

        $authenticationService = $this->getAuthService();
        if (!$user = $authenticationService->getIdentity()) {
            return $this->redirect()->toRoute('tenil-user/login');
        }

        $perfil = $authenticationService->getIdentity()->getId();

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $list = $em->getRepository('TenilEvento\Entity\Inscricao')->findby(array("responsavel" => $perfil));


        return new ViewModel(array('data' => $list));
    }

    public function getAuthService()
    {
        return $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    }

}