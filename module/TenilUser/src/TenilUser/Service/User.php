<?php

/**
 * @author Roberto
 */

namespace TenilUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use TenilBase\Mail\Mail;
use TenilBase\Service\AbstractService;

use Zend\Authentication\AuthenticationService;

class User extends AbstractService
{

    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view)
    {
        // Executa o método contrutor da classe pai.
        parent::__construct($em);

        $this->entity = 'TenilUser\Entity\User';
        $this->transport = $transport;
        $this->view = $view;
    }

    public function insert($entity)
    {
        // Executa o metodo da classe pai e atribui o retorno a variavel
        $entity = parent::insert($entity);

        $dataEmail = array(
            'activationKey' => $entity->getActivationKey()
        );

        //Enviar e-mail
        if ($entity) {
            // Parâmetros: Transport, View e Page
            $mail = new Mail($this->transport, $this->view, 'user-add');
            $mail->setSubjet('Confirmação de cadastro')
                ->setTo($entity->getEmail())
                ->setData($dataEmail)
                ->prepare()
                ->send();
        }

        return $entity;
    }

    public function update(array $data)
    {

        if (empty($data['password'])) {
            unset($data['password']);
        }

        return parent::update($data);
    }

    public function activate($id)
    {

        // Pegando o repository usando o EntityManager;
        $repository = $this->em->getRepository($this->entity);
        // Utilizando um método "mágico";
        $entity = $repository->findOneByActivationKey($id);

        if ($entity && !$entity->getActive()) {

            // Ativando o usuário na conta
            $entity->setActive(TRUE);
            $this->em->persist($entity);
            $this->em->flush();

            $dataEmail = array(
                'nome' => $entity->getPerfil(),
            );

            // Enviando e-mail de confirmação
            // Parâmetros: Transport, View e Page
            $mail = new Mail($this->transport, $this->view, 'user-activate');
            $mail->setSubjet('Confirmação de ativação')
                ->setTo($entity->getEmail())
                ->setData($dataEmail)
                ->prepare()
                ->send();

        }

        return $entity;

    }

    public function passwordReset($email)
    {

        // Pegando o repository usando o EntityManager;
        $repository = $this->em->getRepository($this->entity);
        // Utilizando um método "mágico";
        $entity = $repository->findOneByEmail($email);

        if ($entity) {

            // Criando a chave de recuperação de senha
            $entity->setPasswordResetKey(TRUE);
            $this->em->persist($entity);
            $this->em->flush();

            $dataEmail = array(
                'nome' => $entity->getPerfil(),
                'resetKey' => $entity->getPasswordResetKey()
            );

            // Enviando e-mail de confirmação
            // Parâmetros: Transport, View e Page

            $mail = new Mail($this->transport, $this->view, 'user-reset');
            $mail->setSubjet('Redefinição de senha')
                ->setTo($entity->getEmail())
                ->setData($dataEmail)
                ->prepare()
                ->send();

        }

        return $entity;

    }

    public function findByKey($key)
    {
        // Pegando o repository usando o EntityManager;
        $repository = $this->em->getRepository($this->entity);
        // Utilizando um método "mágico";
        return $repository->findOneByPasswordResetKey($key);
    }

}
