<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 18/05/2015
 * Time: 12:27
 */

namespace TenilUser\Form;

use TenilUser\Entity\Perfil;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PerfilFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('perfil');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Perfil());

        $this->setLabel('Perfil');

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'nome',
            'options' => array(
                'label' => 'Nome'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'sobrenome',
            'options' => array(
                'label' => 'Sobrenome'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'apelido',
            'options' => array(
                'label' => 'Apelido'
            )
        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'tratamento',
            'options' => array(
                'object_manager' => $objectManager,
                'target_class'   => 'TenilUser\Entity\PerfilTratamento',
                'property'       => 'nome',
                'display_empty_item' => true,
                'empty_item_label'   => '---',
            ),
        ));

        $telefoneFieldset = new TelefoneFieldset($objectManager);
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'telefones',
            'options' => array(
                'label' =>'Telefones',
                'count' => 0,
                'should_create_template' => false,
                'allow_add' => true,
                'allow_remove' => true,
                'target_element' => $telefoneFieldset
            )
        ));

        $enderecoFieldset = new EnderecoFieldset($objectManager);
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'enderecos',
            'options' => array(
                'label' => 'Endereços',
                'should_create_template' => true,
                'allow_add' => true,
                'count' => 1,
                'target_element' => $enderecoFieldset
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'nome' => array(
                'required' => true
            ),
            'tratamento' => array(
                'required' => false
            )
        );
    }
}