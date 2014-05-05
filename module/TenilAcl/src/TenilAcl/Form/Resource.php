<?php

namespace TenilAcl\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Resource extends Form {

    public function __construct($name = NULL, $options = array()) {
        parent::__construct($name, $options);

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-horizontal'
        ));

        $this->setInputFilter(new ResourceFilter());

        $id = new Element\Hidden('id');
        $this->add($id);

        $nome = new Element\Text('nome');
        $nome->setLabel('Recurso')
                ->setAttribute('placeholder', 'Informe o nome do Recurso')
                ->setAttribute('class', 'form-control input-lg')
                ->setLabelAttributes(array('class' => 'col-lg-2 control-label'));
        $this->add($nome);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Gravar')->setAttribute('class', 'btn btn-primary btn-lg btn-block');
        $this->add($submit);
    }

}
