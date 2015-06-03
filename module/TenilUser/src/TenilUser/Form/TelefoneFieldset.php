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
use Zend\Validator;

class TelefoneFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('telefone');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Telefone());

        $this->setLabel('Telefone');

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'ddd',
            'options' => array(
                'label' => 'DDD'
            ),
            'attributes' => array(//  'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'numero',
            'options' => array(
                'label' => 'Número'
            ),
            'attributes' => array(//   'required' => 'required'
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
        $validatorDigitos = new Validator\Digits();
        $validatorTamanhoNumero = new Validator\StringLength();
        $validatorTamanhoNumero->setMin(8)->setMax(9);
        $validatorTamanhoDDD = new Validator\StringLength();
        $validatorTamanhoDDD->setMin(2)->setMax(2);
        return array(
            'ddd' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    $validatorTamanhoDDD,
                    $validatorDigitos
                )
            ),
            'numero' => array(
                'required' => true,
                'validators' => array(
                    $validatorTamanhoNumero,
                    $validatorDigitos
                )
            )
        );
    }
}