<?php

/**
 * @author Roberto
 */

namespace TenilUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use TenilBase\Mail\Mail;

class User extends AbstractService {

    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view) {
        // Executa o método contrutor da classe pai.
        parent::__construct($em);

        $this->entity = "TenilUser\Entity\User";
        $this->transport = $transport;
        $this->view = $view;
    }

    public function insert(array $data) {
        // Executa o metodo da classe pai e atribui o retorno a variavel
        $entity = parent::insert($data);

        $dataEmail = array(
            'nome' => $data['nome'],
            'activationKey' => $entity->getActivationKey()
        );
        if ($entity) {
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubjet('Confirmação de cadastro')
                    ->setTo($data['email'])
                    ->setData($dataEmail)
                    ->prepare()
                    ->send();
            return $entity;
        }
    }

}