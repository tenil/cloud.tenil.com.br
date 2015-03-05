<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TenilUser\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

/**
 * Description of Adapter
 *
 * @author Roberto
 */
class Adapter implements AdapterInterface {

    protected $em;
    protected $username;
    protected $password;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function authenticate() {

        $repository = $this->em->getRepository("TenilUser\Entity\User");
        $user = $repository->findByEmailAndPassword($this->getUsername(), $this->getPassword());

        $messages = new FlashMessenger();
        $messages->setNamespace('Tenil');
        
        if ($user) {
            //$messages->addSuccessMessage('Login efetuado com sucesso.');
            return new Result(Result::SUCCESS, array('user' => $user), array('SUCCESS'));
        } else {
            $messages->addErrorMessage('E-mail ou senha incorretos.');
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, NULL, array('ERROR'));
        }
    }

}
