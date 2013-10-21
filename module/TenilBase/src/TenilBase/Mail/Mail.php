<?php

/**
 * @author Roberto
 */

namespace TenilBase\Mail;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\View\Model\ViewModel;

use Zend\Mail\Transport\SmtpOptions;


class Mail {

    protected $transport;
    protected $view;
    protected $body;
    protected $message;
    protected $subject;
    protected $to;
    protected $data;
    protected $page;

    public function __construct(SmtpTransport $transport, $view, $page) {

//        $this->transport = $transport;
        
        
        $options = new SmtpOptions(array(
            'name' => 'tenil.com.br',
            'host' => 'email-smtp.us-east-1.amazonaws.com',
            'port' => 587, // Notice port change for TLS is 587
            'connection_class' => 'plain',
            'connection_config' => array(
                'username' => 'AKIAIMQAL354XXTUFRVQ',
                'password' => 'ApwN9pFWzUkmpsa0LTqODsjz9cSwU+pRE0KIc55uvni3',
                'ssl' => 'tls',
                'from' => 'contato@tenil.com.br',
            ),
        ));
        $tranp = new SmtpTransport();
        $tranp->setOptions($options);        
        
        $this->transport = $tranp;
        
        
        
        
        
        $this->view = $view;
        $this->page = $page;
    }

    public function setSubjet($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function setTo($to) {
        $this->to = $to;
        return $this;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function renderView($page, array $data) {

        $model = new ViewModel;
        $model->setTemplate("mailer/{$page}.phtml");
        $model->setOption('has_parent', TRUE);
        $model->setVariables($data);

        return $this->view->render($model);
    }

    public function prepare() {

        $mimePart = new MimePart($this->renderView($this->page, $this->data));
        $mimePart->type = "text/html";

        $mimeMessage = new MimeMessage();
        $mimeMessage->addPart($mimePart);

        $this->body = $mimeMessage;

        // Aqui ele busca as informação lá do global.php
        $config = $this->transport->getOptions()->toArray();

        $this->message = new Message;
        $this->message
                ->addFrom($config['connection_config']['from'])
                ->setSender($config['connection_config']['from'])
                ->addTo($this->to)
                ->setSubject($this->subject)
                ->setBody($this->body);
        //->setEncoding("UTF-8");

        return $this;
    }

    public function send() {

        $this->transport->send($this->message);

        return $this->message;
    }

}