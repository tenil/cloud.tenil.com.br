<?php

namespace TenilUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Perfil extends Form
{

    protected $tratamento;

    public function __construct($name = null, $options = array(), array $tratamento = NULL, array $tipoFone = NULL)
    {
        parent::__construct($name, $options);

        $this->tratamento = $tratamento;
        $this->tipoFone = $tipoFone;

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
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
            ->setValueOptions($this->tratamento)
            ->setEmptyOption('Tratamento');
        $this->add($tratamentos);

        $nome = new Element\Text('nome');
        $nome->setLabel('Nome')
            ->setAttribute('placeholder', 'Nome')
            ->setAttribute('class', 'form-control')
            ->setAttribute('required', 'required')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($nome);

        $sobrenome = new Element\Text('sobrenome');
        $sobrenome->setLabel('Sobrenome')
            ->setAttribute('placeholder', 'Sobrenome')
            ->setAttribute('class', 'form-control')
            ->setAttribute('required', 'required')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($sobrenome);

        $fone1ddd = new Element\Text('fone1ddd');
        $fone1ddd->setLabel('DDD')
            ->setAttribute('placeholder', 'DDD')
            ->setAttribute('class', 'form-control')
            ->setAttribute('required', 'required')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($fone1ddd);

        $fone1numero = new Element\Text('fone1numero');
        $fone1numero->setLabel('Telefone')
            ->setAttribute('placeholder', 'Número')
            ->setAttribute('class', 'form-control')
            ->setAttribute('required', 'required')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($fone1numero);

        $fone1tipo = new Element\Select('fone1tipo');
        $fone1tipo->setLabel('Tipo')
            ->setAttribute('placeholder', 'Tipo')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
            ->setValueOptions($this->tipoFone)
            ->setEmptyOption('Tipo fone');
        $this->add($fone1tipo);

        $fone2ddd = new Element\Text('fone2ddd');
        $fone2ddd->setLabel('DDD')
            ->setAttribute('placeholder', 'DDD')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($fone2ddd);

        $fone2numero = new Element\Text('fone2numero');
        $fone2numero->setLabel('Telefone')
            ->setAttribute('placeholder', 'Número')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($fone2numero);

        $fone2tipo = new Element\Select('fone2tipo');
        $fone2tipo->setLabel('Tipo')
            ->setAttribute('placeholder', 'Tipo')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
            ->setValueOptions($this->tipoFone)
            ->setEmptyOption('Tipo fone');
        $this->add($fone2tipo);

        $fone3ddd = new Element\Text('fone3ddd');
        $fone3ddd->setLabel('DDD')
            ->setAttribute('placeholder', 'DDD')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($fone3ddd);

        $fone3numero = new Element\Text('fone3numero');
        $fone3numero->setLabel('Telefone')
            ->setAttribute('placeholder', 'Número')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($fone3numero);

        $fone3tipo = new Element\Select('fone3tipo');
        $fone3tipo->setLabel('Tipo')
            ->setAttribute('placeholder', 'Tipo')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
            ->setValueOptions($this->tipoFone)
            ->setEmptyOption('Tipo fone');
        $this->add($fone3tipo);

        $logradouro = new Element\Text('logradouro');
        $logradouro->setLabel('Endereço')
            ->setAttribute('placeholder', 'Endereço (Rua | Logradouro)')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($logradouro);

        $numero = new Element\Text('numero');
        $numero->setLabel('Número')
            ->setAttribute('placeholder', 'Número (casa/apto/lote)')
            ->setAttribute('class', 'form-control col-md-4')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($numero);

        $complemento = new Element\Text('complemento');
        $complemento->setLabel('Complemento')
            ->setAttribute('placeholder', 'Complemento (se houver)')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($complemento);

        $bairro = new Element\Text('bairro');
        $bairro->setLabel('Bairro')
            ->setAttribute('placeholder', 'Bairro')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($bairro);

        $cidade = new Element\Text('localidade');
        $cidade->setLabel('Cidade')
            ->setAttribute('placeholder', 'Cidade')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($cidade);

        $estado = new Element\Text('uf');
        $estado->setLabel('Estado')
            ->setAttribute('placeholder', 'Estado (UF)')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($estado);

        $cep = new Element\Text('cep');
        $cep->setLabel('CEP')
            ->setAttribute('placeholder', 'CEP')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($cep);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Salvar')->setAttribute('class', 'btn btn-default');
        $this->add($submit);
    }

}
