<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 18/05/2015
 * Time: 12:27
 */

namespace TenilUser\Form;

use TenilUser\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Form\Element;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('user');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new User());

        $id = new Element\Hidden('id');
        $this->add($id);

        $email = new Element\Email('email');
        $email->setLabel('E-mail')
            // ->setAttribute('placeholder', 'E-mail')
            // ->setAttribute('class', 'form-control')
            ->setAttribute('required', 'required');
            // ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
           //->setAttribute('id', 'email');
        $this->add($email);

        $password = new Element\Password('password');
        $password->setLabel('Senha')
            // ->setAttribute('placeholder', 'Senha')
            // ->setAttribute('class', 'form-control')
            ->setAttribute('required', 'required');
            // ->setLabelAttributes(array('class' => 'col-md-2 control-label'))
            //->setAttribute('id', 'senha');
            
        $this->add($password);

        $perfilFieldset = new PerfilFieldset($objectManager);
        $perfilFieldset->setLabel('Perfil');
        $perfilFieldset->setName('perfil');
        $this->add($perfilFieldset);

    }

    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false
            ),
            'email' => array(
                'required' => true
            ),
            'password' => array(
                'required' => true
            )
        );
    }
}