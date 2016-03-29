<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/03/2016
 * Time: 16:34
 */

namespace TenilEvento\Form;


use Zend\Form\Form;
use Zend\Form\Element;

class Retorno extends Form
{

    public function __construct($name = null, $options = array())
    {

        parent::__construct('retorno');

        $this->setInputFilter(new RetornoFilter());
        $this->addElements();
        $this->setAttributes(array(
            'method' => 'POST',
            'role' => 'form',
            'class' => 'form-horizontal',
        ));
        $this->setLabel('Enviar arquivo de retorno do banco');

    }

    public function addElements()
    {
        // File Input
        $file = new Element\File('arquivo');
        $file->setLabel('Selecione o arquivo de Retorno');
        $file->setAttribute('id', 'arquivo');
        $file->setAttribute('accept', '.ret');
        $this->add($file);

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Enviar')->setAttribute('class', 'btn btn-primary');
        $this->add($submit);

    }

}