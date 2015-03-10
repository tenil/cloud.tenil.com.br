<?php

namespace TenilUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Perfil extends Form {
    
    protected $tratamento;

    public function __construct($name = null, $options = array(), array $tratamento = NULL) {
        parent::__construct($name, $options);
        
        $this->tratamento = $tratamento;        

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-horizontal',
            'label' => 'Editar perfil'
        ));

        $this->setInputFilter(new PerfilFilter());

        $id = new Element\Hidden('id');
        $this->add($id);
        
        $tratamentos = new Element\Select('tratamento');
        $tratamentos->setLabel('Tratamento')
                ->setAttribute('placeholder', 'Forma de tratamento')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'))
                ->setValueOptions($this->tratamento)
                ->setEmptyOption('Nenhum');
        $this->add($tratamentos); 
        
        $nome = new Element\Text('nome');
        $nome->setLabel('Nome')
                ->setAttribute('placeholder', 'Informe seu nome')
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', 'required')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($nome);

        $sobrenome = new Element\Text('sobrenome');
        $sobrenome->setLabel('Sobrenome')
                ->setAttribute('placeholder', 'Informe seu sobrenome')
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', 'required')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($sobrenome);

        $fone1numero = new Element\Text('fone1numero');
        $fone1numero->setLabel('Telefone')
                ->setAttribute('placeholder', 'Informe um telefone')
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', 'required')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($fone1numero);

        $endereco = new Element\Text('endereco');
        $endereco->setLabel('Endereço')
                ->setAttribute('placeholder', 'Informe o endereço (logradouro)')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($fone1numero);

        $numero = new Element\Text('numero');
        $numero->setLabel('Número')
                ->setAttribute('placeholder', 'Informe número (casa/apto/lote)')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($numero);

        $complemento = new Element\Text('complemento');
        $complemento->setLabel('Complemento')
                ->setAttribute('placeholder', 'Informe o complemento se houver')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($complemento);

        $bairro = new Element\Text('bairro');
        $bairro->setLabel('Bairro')
                ->setAttribute('placeholder', 'Informe o bairro')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($bairro);

        $cidade = new Element\Text('cidade');
        $cidade->setLabel('Cidade')
                ->setAttribute('placeholder', 'Informe a cidade')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($cidade);

        $estado = new Element\Text('estado');
        $estado->setLabel('Estado')
                ->setAttribute('placeholder', 'Informe o estado')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($estado);

        $cep = new Element\Text('cep');
        $cep->setLabel('cep')
                ->setAttribute('placeholder', 'Informe a CEP')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
        $this->add($cep);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Salvar')->setAttribute('class', 'btn btn-default');
        $this->add($submit);
    }

}
