<?php

namespace TenilUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class User extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('User', $options);

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-signin',
            'label' => 'Crie sua conta.'
        ));

        $this->setInputFilter(new UserFilter());

        $id = new Element\Hidden('id');
        $this->add($id);

        $nome = new Element\Text('nome');
        $nome->setLabel('Nome')
                ->setAttribute('placeholder', 'Informe seu nome')
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', 'required');
        $this->add($nome);

        $email = new Element\Email('email');
        $email->setLabel('E-mail')
                ->setAttribute('placeholder', 'Informe o e-mail')
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', 'required')
                ->setAttribute('autofocus', 'autofocus');
        $this->add($email);

        $password = new Element\Password('password');
        $password->setLabel('Senha')
                ->setAttribute('placeholder', 'Digite a senha')
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', 'required');
        $this->add($password);

        $confirmation = new Element\Password('confirmation');
        $confirmation->setLabel('Confirmação')
                ->setAttribute('placeholder', 'Redigite a senha')
                ->setAttribute('class', 'form-control');
        $this->add($confirmation);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Criar uma conta')->setAttribute('class', 'btn btn-lg btn-primary btn-block');
        $this->add($submit);
    }

}
