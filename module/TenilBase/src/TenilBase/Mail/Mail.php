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

        $this->transport = $transport;
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

        $texto = $this->renderView($this->page, $this->data);

        $mimePart = new MimePart($texto);
        $mimePart->type = "text/html";
        $mimePart->charset = "UTF-8";

        $mimeMessage = new MimeMessage();
        $mimeMessage->addPart($mimePart);

        $this->body = $mimeMessage;

        // Aqui ele recupera as informações lá do global.php
        $config = $this->transport->getOptions()->toArray();

        $this->message = new Message();
        $this->message
                ->addTo($this->to)
                ->addFrom($config['connection_config']['from'])
                ->setSender($config['connection_config']['from'])
                ->setSubject($this->subject)
                ->setBody($this->body);

        return $this;
    }

    public function send() {

        $this->transport->send($this->message);
        return $this->message;
    }

}