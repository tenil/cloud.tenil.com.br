<?php

namespace TenilAcl\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Role extends Form {

    protected $parent;

    public function __construct($name = NULL, $options = array(), array $parent = NULL) {
        parent::__construct($name, $options);

        $this->parent = $parent;
        
        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-horizontal'
        ));

        $this->setInputFilter(new RoleFilter());

        $id = new Element\Hidden('id');
        $this->add($id);

        $nome = new Element\Text('nome');
        $nome->setLabel('Papel')
                // ->setAttribute('placeholder', 'Informe o nome do Papel')
                // ->setAttribute('class', 'form-control')
                // ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
        ;
        $this->add($nome);

        $parents = new Element\Select('parent');
        $parents->setLabel('Pai')
                // ->setAttribute('placeholder', 'Pai')
                // ->setAttribute('class', 'form-control')
                // ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
                ->setValueOptions($this->parent)
                ->setEmptyOption('Nenhum', NULL);
        $this->add($parents);
        
        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Salvar');
        $this->add($submit);
    }

}
