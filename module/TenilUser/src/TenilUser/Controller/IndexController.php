<?php

/**
 * @author Roberto
 */

namespace TenilUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use TenilUser\Form\User as FormUser;
use Zend\Mail;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

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
            // Verificando se os dados do formulário são válidos (filters e validators).
            if ($form->isValid()) {
                // Criando uma instância da classe de serviço do Module.php
                $service = $this->getServiceLocator()->get('TenilUser\Service\User');
                // Se a inserção for verdadeira, entra no if.
                if ($service->insert($request->getPost()->toArray())) {
                    // Aprimorar para mensagens de status.
                    $this->flashMessenger()
                            ->setNamespace('TenilUser')
                            ->addMessage('Usuário cadastrado com sucesso!');
                }

                return $this->redirect()->toRoute('tenil-user-register');
            }
        }

        $messages = $this->flashMessenger()
                ->setNamespace('TenilUser')
                ->getMessages();

        return new ViewModel(array(
            'form' => $form,
            'messages' => $messages
        ));
    }

    public function enviarEmailAction() {

        $message = new Message();
        $message->addTo('roberto.tenil@gmail.com')
                ->addFrom('roberto.tenil@gmail.com')
                ->setSubject('Greetings and Salutations!')
                ->setBody("Sorry, I'm going to be late today!");

        // Setup SMTP transport using LOGIN authentication
        $transport = new SmtpTransport();
        $options = new SmtpOptions(array(
            'name' => 'tenil.com.br',
            'host' => 'email-smtp.us-east-1.amazonaws.com',
            'connection_class' => 'login',
            'connection_config' => array(
                'username' => 'AKIAIMQAL354XXTUFRVQ',
                'password' => 'ApwN9pFWzUkmpsa0LTqODsjz9cSwU+pRE0KIc55uvni3',
                'ssl' => 'tls',
                'port' => 587,
                'from' => 'contato@tenil.com.br',
            )
                )
        );
        $transport->setOptions($options);
        $transport->send($message);
        
        $messages = $transport->getOptions()->toArray();

        return new ViewModel(array('messages' => $messages));
    }

}