<?php

/**
 * @author Roberto
 */

namespace TenilEvento\Service;

use Doctrine\ORM\EntityManager;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use TenilBase\Mail\Mail;
use TenilBase\Service\AbstractService;


class Evento extends AbstractService
{

    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view)
    {
        // Executa o método contrutor da classe pai.
        parent::__construct($em);
        $this->entity = 'TenilEvento\Entity\Evento';
        $this->transport = $transport;
        $this->view = $view;

    }

    public function dispararEmail(array $data)
    {
        // Parâmetros: Transport, View e Page
        $mail = new Mail($this->transport, $this->view, 'evento-inscricao');
        $mail->setSubjet('Inscrição realizada')
            ->setTo($data['email'])
            ->setData($data)
            ->prepare()
            ->send();
        
        return $data;
    }

}
