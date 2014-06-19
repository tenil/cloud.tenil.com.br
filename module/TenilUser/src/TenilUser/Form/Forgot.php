<?php

namespace TenilUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Forgot extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('Forgot', $options);

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-signin',
            'label' => 'Redefinir senha'
        ));
        
        $this->setInputFilter(new ForgotFilter());

        $email = new Element\Email('email');
        $email->setLabel('E-mail')
                ->setAttribute('placeholder', 'E-mail')
                ->setAttribute('class', 'form-control')
                ->setAttribute('autofocus', 'autofocus')
                ->setAttribute('required', 'required');
        $this->add($email);
        
        $security = new Element\Csrf('security');
        $this->add($security);
        
        $submit = new Element\Submit('submit');
        $submit->setValue('Redefinir minha senha')->setAttribute('class', 'btn btn-lg btn-primary btn-block');
        $this->add($submit);
    }

}