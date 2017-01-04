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
        $this->add($nome);

        $role = new Element\Select('role');
        $role->setLabel('Papel')
                ->setValueOptions($this->role)
                ->setEmptyOption('Nenhum');
        $this->add($role);
        
        $resource = new Element\Select('resource');
        $resource->setLabel('Recurso')
                ->setValueOptions($this->resource)
                ->setEmptyOption('Nenhum');
        $this->add($resource);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Salvar');
        $this->add($submit);
    }

}
