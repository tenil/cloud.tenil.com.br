<?php

/**
 * @author Roberto
 */

namespace TenilUser\Controller;

use TenilUser\Entity\Perfil;
use TenilUser\Entity\User;
use TenilUser\Form\UserFormCreate;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use TenilUser\Form\User as FormUser;
use TenilUser\Form\Forgot as FormForgot;
use TenilUser\Form\Reset as FormReset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class IndexController extends AbstractActionController
{

    protected $em; //
    protected $user;
    protected $authService;

    public function getAuthService()
    {
        return $this->authService;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function registerAction()
    {

        // Get ObjectManager from the ServiceManager
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        // Create the form and inject the ObjectManager
        $form = new UserFormCreate($objectManager);
        $form->setAttributes(array(
            'class' => 'form-signin',
            'label' => 'Crie sua conta'
        ));

        // Criando uma variável de controle de erro
        $erro = (boolean)false;

        // Create a new, empty entity and bind it to the form
        $user = new User();

        $form->bind($user);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                try {
                    $objectManager->persist($user);
                    $objectManager->flush();
                } catch (\Exception $e) {
                    $erro = true;
                }
                if ($erro) {
                    $this->flashMessenger()->addErrorMessage('Esse e-mail já está em uso.');
                } else {
                    $this->flashMessenger()->addSuccessMessage('Um link para ativação da sua conta foi enviado para seu e-mail.');
                    return $this->redirect()->toRoute('tenil-user/login');
                }
            }
        }

        return array('form' => $form);
    }

    public function doctrineAction()
    {

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $hydrator = new DoctrineHydrator($entityManager);
        $user = new User();
        $perfil = new Perfil();
        $perfil->setNome('Roberto');
        $perfil->setSobrenome('Santos');
        $perfil->setUser($user);


        $data = array(
            'email' => 'doctrine@tenil.com.br',
            'password' => 'p@$$w0rd',
            'perfil' => $perfil
        );

        $user = $hydrator->hydrate($data, $user);

        //  var_dump( $user ); die;

        $entityManager->persist($user);
        $entityManager->flush();

        echo $user->getEmail(); // prints "The best blog post in the world !"
        echo $user->getPerfil(); // prints 2

        die;
    }


//    public function registerActionBkp() {
//
//        /**
//         * @todo Se o usuário estiver logado, não permitir acesso.
//         */
//
//        // Primeira coisa a fazer é chamar o Form, ele vai aparecer sempre.
//        $form = new FormUser;
//        $form->setAttributes(array(
//            'class' => 'form-signin',
//            'label' => 'Crie sua conta'
//        ));
//        // Também recupera informações do REQUEST
//        $request = $this->getRequest();
//
//        // Verificar se os dados vieram de GET ou POST
//        if ($request->isPost()) {
//            // Preenchendo os dados recuperado novamente no formulário
//            $form->setData($request->getPost());
//            // Verificando se os dados do formulário
//            // são válidos (filters e validators).
//            if ($form->isValid()) {
//                // Criando uma instância da classe de serviço do Module.php
//                $service = $this->getServiceLocator()->get('TenilUser\Service\User');
//                // Se a inserção for verdadeira, entra no if.
//                //if ($service->insert($request->getPost()->toArray())) {
//                if ($service->insert($form->getData())) {
//                    /**
//                     * @todo Aprimorar mensagens de status.
//                     */
//                    $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Um link para ativação da sua conta foi enviado para seu e-mail.');
//                    return $this->redirect()->toRoute('tenil-user/default', array('controller' => 'auth', 'action' => 'index'));
//                }
//            } else {
//                foreach ($form->getMessages() as $message) {
//                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
//                }
//            }
//        }
//
//        $view = new ViewModel();
//        //$this->layout('layout/login');
//        $view->setVariables(array('form' => $form));
//
//        return $view;
//    }

    public function activateAction()
    {

        $activationKey = $this->params()->fromRoute('key');
        $userService = $this->getServiceLocator()->get('TenilUser\Service\User');

        $result = $userService->activate($activationKey);

        if ($result) {
            $message = 'Conta ativada com sucesso';
            $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage($message);
        } else {
            $message = 'Chave de ativação de conta não encontrada';
            $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
        }

        return $this->redirect()->toRoute('tenil-user/default', array('controller' => 'auth', 'action' => 'index'));
    }

    public function forgotAction()
    {

        /**
         * @todo Não permitir acesso se o usuário estiver logado.
         */

        $form = new FormForgot;
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
                return $this->redirect()->toRoute('tenil-user/default', array('controller' => 'auth', 'action' => 'login'));
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                }
            }
        }

        $view = new ViewModel(array('form' => $form));
        //$this->layout('layout/login');
        return $view;
    }

    public function resetAction()
    {

        /**
         * @todo Não permitir acesso se o usuário estiver logado
         */

        $resetKey = $this->params()->fromRoute('key');
        $request = $this->getRequest();

        $form = new FormReset;

        if (isset($resetKey)) {
            $userService = $this->getServiceLocator()->get('TenilUser\Service\User');
            $user = $userService->findByKey($resetKey);

            if ($user) {
                $form->get('id')->setValue($user->getId());
            } else {
                $message = 'Link para redefinir senha inválido';
                $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                return $this->redirect()->toRoute('tenil-user/default', array('controller' => 'auth', 'action' => 'index'));
            }
        } else {

            if ($request->isPost()) {
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $data = $form->getData();
                    $data['passwordResetKey'] = NULL;

                    $service = $this->getServiceLocator()->get('TenilUser\Service\User');
                    $service->update($data);

                    $message = 'Senha atualizada com sucesso';
                    $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage($message);
                    return $this->redirect()->toRoute('tenil-user/default', array('controller' => 'auth', 'action' => 'index'));
                } else {
                    foreach ($form->getMessages() as $message) {
                        $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                    }
                }
            } else {
                return $this->redirect()->toRoute('tenil-user/default', array('controller' => 'index', 'action' => 'forgot'));
            }
        }

        $view = new ViewModel(array('form' => $form));
        //$this->layout('layout/login');
        return $view;
    }

}
