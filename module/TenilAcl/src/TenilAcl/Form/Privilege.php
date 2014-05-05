<?php

namespace TenilAcl\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Privilege extends Form {

    protected $role;
    protected $resource;

    public function __construct($name = NULL, $options = array(), array $role = NULL, array $resource = NULL ) {
        parent::__construct($name, $options);

        $this->role = $role;
        $this->resource = $resource;
        
        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-horizontal'
        ));

        $this->setInputFilter(new PrivilegeFilter());

        $id = new Element\Hidden('id');
        $this->add($id);

        $nome = new Element\Text('nome');
        $nome->setLabel('Privilégio')
                ->setAttribute('placeholder', 'Informe o nome do Privilégio')
                ->setAttribute('class', 'form-control input-lg')
                ->setLabelAttributes(array('class' => 'col-lg-2 control-label'));
        $this->add($nome);

        $role = new Element\Select('role');
        $role->setLabel('Papel')
                ->setAttribute('placeholder', 'Informe o nome do Papel')
                ->setAttribute('class', 'form-control input-lg')
                ->setLabelAttributes(array('class' => 'col-lg-2 control-label'))
                ->setValueOptions($this->role)
                ->setEmptyOption('Nenhum');
        $this->add($role);
        
        $resource = new Element\Select('resource');
        $resource->setLabel('Recurso')
                ->setAttribute('placeholder', 'Informe o nome do Recurso')
                ->setAttribute('class', 'form-control input-lg')
                ->setLabelAttributes(array('class' => 'col-lg-2 control-label'))
                ->setValueOptions($this->resource)
                ->setEmptyOption('Nenhum');
        $this->add($resource);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Gravar')->setAttribute('class', 'btn btn-primary btn-lg btn-block');
        $this->add($submit);
    }

}
