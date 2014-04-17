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
        
        
        
    }

}
