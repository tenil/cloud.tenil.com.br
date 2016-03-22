<?php

namespace TenilUser\Controller;


use TenilBase\Controller\CrudController;

class UserController extends CrudController
{

    public function __construct()
    {

        $this->controller = 'user';
        $this->entity = 'TenilUser\Entity\User';
        $this->form = 'TenilUser\Form\UserFormCreate';
        $this->route = 'tenil-user/default';
        $this->service = 'TenilUser\Service\User';
    }

    public function registerAction()
    {

        // Get ObjectManager from the ServiceManager
        $objectManager = $this->getEm();

        // Create the form and inject the ObjectManager
        $form = new $this->form($objectManager);

        // Criando uma variável de controle de erro
        $erro = (boolean)false;

        // Create a new, empty entity and bind it to the form
        $entity = new $this->entity();

        $form->bind($entity);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                try {
                    $service = $this->getServiceLocator()->get($this->service);
                    $service->insert($entity);
                } catch (\Exception $e) {
                    $erro = true;
                }
                if ($erro) {
                    $this->flashMessenger()->addErrorMessage('Esse e-mail já está em uso.');
                } else {
                    $this->flashMessenger()->addSuccessMessage('Um link para ativação da sua conta foi enviado para seu e-mail.');
                    $this->flashMessenger()->addInfoMessage('Se o e-mail não estiver na sua caixa de entrada, vefifique o lixo eletrônico.');
                    return $this->redirect()->toRoute('tenil-auth/default', array('action' => 'login'));
                }
            }
        }

        return array('form' => $form);
    }

    public function activateAction()
    {

        $activationKey = $this->params()->fromRoute('id');
        $service = $this->getServiceLocator()->get($this->service);

        $result = $service->activate($activationKey);

        if ($result) {
            $message = 'Conta ativada com sucesso';
            $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage($message);
        } else {
            $message = 'Chave de ativação de conta não encontrada';
            $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
        }

        return $this->redirect()->toRoute('tenil-auth/default', array('action' => 'login'));
    }

    public function forgotAction()
    {

        /**
         * @todo Não permitir acesso se o usuário estiver logado.
         */

        $form = new \TenilUser\Form\Forgot();
        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();

                // buscar no banco
                // gerar chave
                // enviar e-mail com chave
                $userService = $this->getServiceLocator()->get('TenilUser\Service\User');
                $userService->passwordReset($data['email']);

                // escrever mensagem de envio
                $message = 'Se o e-mail especificado existe no nosso sistema, nós enviamos um link de redefinição de senha para ele.';
                $this->flashMessenger()->setNamespace('Tenil')->addInfoMessage($message);

                // redirecionar para tela de login
                return $this->redirect()->toRoute('tenil-auth/default', array('action' => 'login'));
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                }
            }
        }
        return array('form' => $form);
    }

    public function resetAction()
    {

        /**
         * @todo Não permitir acesso se o usuário estiver logado
         */

        $resetKey = $this->params()->fromRoute('id');
        $request = $this->getRequest();

        $form = new \TenilUser\Form\Reset();

        if (isset($resetKey)) {
            $service = $this->getServiceLocator()->get($this->service);
            $user = $service->findByKey($resetKey);

            if ($user) {
                $form->get('id')->setValue($user->getId());
            } else {
                $message = 'Link para redefinir senha inválido';
                $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                return $this->redirect()->toRoute('tenil-auth/default', array('action' => 'login'));
            }
        } else {

            if ($request->isPost()) {
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $data = $form->getData();
                    $data['passwordResetKey'] = NULL;

                    $service = $this->getServiceLocator()->get($this->service);
                    $service->update($data);

                    $message = 'Senha atualizada com sucesso';
                    $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage($message);
                    return $this->redirect()->toRoute('tenil-auth/default', array('action' => 'login'));
                } else {
                    foreach ($form->getMessages() as $message) {
                        $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                    }
                }
            } else {
                return $this->redirect()->toRoute('tenil-user/default', array('action' => 'forgot'));
            }
        }

        return array('form' => $form);

    }

}
