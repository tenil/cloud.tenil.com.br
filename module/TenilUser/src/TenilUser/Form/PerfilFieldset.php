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

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'nome',
            'options' => array(
                'label' => 'Nome'
            )
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

        $telefoneFieldset = new TelefoneFieldset($objectManager);
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'telefones',
            'options' => array(
                'count' => 3,
                'target_element' => $telefoneFieldset
            )
        ));

        $enderecoFieldset = new EnderecoFieldset($objectManager);
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'enderecos',
            'options' => array(
                'count' => 1,
                'target_element' => $enderecoFieldset
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false
            )
        );
    }
}