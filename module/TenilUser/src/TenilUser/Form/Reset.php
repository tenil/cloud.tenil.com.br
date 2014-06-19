<?php

namespace TenilUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Reset extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('Reset', $options);

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-signin',
            'label' => 'Redefina sua senha'
        ));

        $this->setInputFilter(new ResetFilter());

        $id = new Element\Hidden('id');
        $this->add($id);

        $password = new Element\Password('password');
        $password->setLabel('Senha')
                ->setAttribute('placeholder', 'Digite a senha')
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', 'required');
        $this->add($password);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Redefinir senha')->setAttribute('class', 'btn btn-lg btn-primary btn-block');
        $this->add($submit);
    }

}
