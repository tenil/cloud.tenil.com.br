<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 07/03/2016
 * Time: 15:59
 */

namespace TenilEvento\Form;

use TenilEvento\Entity\Inscricao;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Db\Sql\Predicate\In;
use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Zend\Form\Element;

class InscricaoFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('inscricao');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Inscricao());

        $this->setLabel('Inscrição');

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'E-mail'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'nome',
            'options' => array(
                'label' => 'Nome'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'cpf',
            'options' => array(
                'label' => 'CPF'
            )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Date',
                'name' => 'dataNascimento',
                'options' => array(
                    'label' => 'Data de Nascimento',
                    'format' => 'd-m-Y'
                ),
                'attributes' => array(
                    'min' => '01-01-1900',
                    'max' => '01-08-2016',
                    'step' => '1', // days; default step interval is 1 day
                )
            )

        );

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
            'name' => 'uf',
            'options' => array(
                'label' => 'UF'
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

    public function getInputFilterSpecification()
    {
        return array(
            'nome' => array(
                'required' => true
            ),
            'email' => array(
                'required' => false
            ),
            'cpf' => array(
                'required' => true
            ),
            'dataNascimento' => array(
                'required' => true
            ),

            'logradouro' => array(
                'required' => true
            ),

            'numero' => array(
                'required' => true
            ),

            'bairro' => array(
                'required' => true
            ),

            'localidade' => array(
                'required' => true
            ),

            'uf' => array(
                'required' => true
            ),

            'cep' => array(
                'required' => true
            ),

        );

    }

    public function setOption($key, $value)
    {
        // TODO: Implement setOption() method.
    }
}