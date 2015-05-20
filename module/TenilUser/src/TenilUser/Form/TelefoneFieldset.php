<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 18/05/2015
 * Time: 12:30
 */

namespace TenilUser\Form;

use TenilUser\Entity\Telefone;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class TelefoneFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('telefone');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Telefone());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'ddd',
            'options' => array(
                'label' => 'DDD'
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
            'name' => 'ramal',
            'options' => array(
                'label' => 'Ramal'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'contato',
            'options' => array(
                'label' => 'Contato'
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
            )
        );
    }
}