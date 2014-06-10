<?php

/**
 * @author Roberto
 */

namespace TenilUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use TenilUser\Form\User as FormUser;

class IndexController extends AbstractActionController {

    public function registerAction() {

        // Primeira coisa a fazer é chamar o Form, ele vai aparecer sempre.
        $form = new FormUser;
        // Também recupera informações do REQUEST
        $request = $this->getRequest();

        // Verificar se os dados vieram de GET ou POST
        if ($request->isPost()) {
            // Preenchendo os dados recuperado novamente no formulário
            $form->setData($request->getPost());
            // Verificando se os dados do formulário 
            // são válidos (filters e validators).
            if ($form->isValid()) {
                // Criando uma instância da classe de serviço do Module.php
                $service = $this->getServiceLocator()->get('TenilUser\Service\User');
                // Se a inserção for verdadeira, entra no if.
                //if ($service->insert($request->getPost()->toArray())) {
                if ($service->insert($form->getData())) {
                    // Aprimorar para mensagens de status.
                    $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Usuário cadastrado com sucesso!');
                }

                return $this->redirect()->toRoute('tenil-user-register');
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                }
            }
        }

        $view = new ViewModel();
        $view->setVariables(array('form' => $form));

        return $view;
    }

    public function activateAction() {

        $activationKey = $this->params()->fromRoute('key');
        $userService = $this->getServiceLocator()->get('TenilUser\Service\User');

        $result = $userService->activate($activationKey);

        if ($result) {
            return new ViewModel(array(
                'user' => $result
            ));
        } else {
            return new ViewModel();
        }
    }

}
