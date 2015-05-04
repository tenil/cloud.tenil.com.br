<?php

/**
 * @author Roberto
 */

namespace TenilUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use TenilBase\Mail\Mail;
use TenilBase\Service\AbstractService;

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

    public function insert(array $data)
    {
        // Executa o metodo da classe pai e atribui o retorno a variavel
        $entity = parent::insert($data);

        $dataEmail = array(
            'activationKey' => $entity->getActivationKey()
        );

        //Enviar e-mail
        if ($entity) {
            // Parâmetros: Transport, View e Page
            $mail = new Mail($this->transport, $this->view, 'user-add');
            $mail->setSubjet('Confirmação de cadastro')
                ->setTo($data['email'])
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

    public function activate($key)
    {

        // Pegando o repository usando o EntityManager;
        $repo = $this->em->getRepository('TenilUser\Entity\User');
        // Utilizando um método "mágico";
        $user = $repo->findOneByActivationKey($key);

        if ($user && !$user->getActive()) {

            // Ativando o usuário na conta
            $user->setActive(TRUE);
            $this->em->persist($user);
            $this->em->flush();

            $dataEmail = array(
                'nome' => $user->getNome(),
            );

            // Enviando e-mail de confirmação
            // Parâmetros: Transport, View e Page
            $mail = new Mail($this->transport, $this->view, 'user-activate');
            $mail->setSubjet('Confirmação de ativação')
                ->setTo($user->getEmail())
                ->setData($dataEmail)
                ->prepare()
                ->send();


            return $user;
        }
    }

    public function passwordReset($email)
    {

        // Pegando o repository usando o EntityManager;
        $repo = $this->em->getRepository('TenilUser\Entity\User');
        // Utilizando um método "mágico";
        $user = $repo->findOneByEmail($email);

        if ($user) {

            // Criando a chave de recuperação de senha
            $user->setPasswordResetKey(TRUE);
            $this->em->persist($user);
            $this->em->flush();

            $dataEmail = array(
                'nome' => $user->getNome(),
                'resetKey' => $user->getPasswordResetKey()
            );

            // Enviando e-mail de confirmação
            // Parâmetros: Transport, View e Page
            $mail = new Mail($this->transport, $this->view, 'user-reset');
            $mail->setSubjet('Redefinição de senha')
                ->setTo($user->getEmail())
                ->setData($dataEmail)
                ->prepare()
                ->send();

            return $user;
        }
    }

    public function findByKey($key)
    {
        // Pegando o repository usando o EntityManager;
        $repo = $this->em->getRepository('TenilUser\Entity\User');
        // Utilizando um método "mágico";
        return $repo->findOneByPasswordResetKey($key);
    }

}
