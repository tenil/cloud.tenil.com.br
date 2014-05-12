<?php

namespace TenilUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Login extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('Login', $options);

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-signin',
            'label' => 'Bem-vindo!'
        ));
        
        // $this->setInputFilter(new LoginFilter());

        $email = new Element\Email('email');
        $email->setLabel('E-mail')
                ->setAttribute('placeholder', 'E-mail')
                ->setAttribute('class', 'form-control')
//                ->setAttribute('required', 'required')
//                ->setAttribute('autofocus', 'autofocus')
                ->setLabelAttributes(array('class' => 'col-lg-2 control-label'));
        $this->add($email);
        
        $password = new Element\Password('password');
        $password->setLabel('Senha')
                ->setAttribute('placeholder', 'Senha')
                ->setAttribute('class', 'form-control')
//                ->setAttribute('required', 'required')
                ->setLabelAttributes(array('class' => 'col-lg-2 control-label'));
        $this->add($password);
        
        $submit = new Element\Submit('submit');
        $submit->setValue('Entrar')->setAttribute('class', 'btn btn-primary btn-lg btn-block');
        $this->add($submit);
    }

}