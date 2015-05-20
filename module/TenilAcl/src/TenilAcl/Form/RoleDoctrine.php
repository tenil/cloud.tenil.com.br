<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 13/05/2015
 * Time: 16:55
 */

namespace TenilAcl\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoleDoctrine extends Form implements ObjectManagerAwareInterface
{

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $objectManager;

    public function init()
    {

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
            ->setAttribute('placeholder', 'Informe o nome do Papel')
            ->setAttribute('class', 'form-control')
            ->setLabelAttributes(array('class' => 'col-md-2 control-label'));
        $this->add($nome);

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'parent',
            'options' => array(
                'object_manager' => $this->getObjectManager()->getRepository('TenilAcl\Entity\Role'),
                'target_class' => 'TenilAcl\Entity\Role',
                'property' => 'nome',
                'empty_option' => '--- please choose ---',
            ),
        ));

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Salvar')->setAttribute('class', 'btn btn-default');
        $this->add($submit);

    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }
}