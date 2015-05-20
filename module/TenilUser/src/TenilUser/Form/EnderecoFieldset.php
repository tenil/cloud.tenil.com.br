<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 18/05/2015
 * Time: 12:30
 */

namespace TenilUser\Form;

use TenilUser\Entity\Endereco;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class EnderecoFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('endereco');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Endereco());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'logradouro',
            'options' => array(
                'label' => 'Endereço'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'numero',
            'options' => array(
                'label' => 'Número'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'bairro',
            'options' => array(
                'label' => 'Bairro'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'localidade',
            'options' => array(
                'label' => 'Cidade'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'UF',
            'options' => array(
                'label' => 'uf'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'cep',
            'options' => array(
                'label' => 'CEP'
            )
        ));

    }


    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false
            ),

        );
    }
}