<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 18/05/2015
 * Time: 15:54
 */

namespace TenilUser\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;
use Zend\Form\Element;

class UserFormCreate extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('user-form-create');

        // The form will hydrate an object of type "Perfil"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $userFieldset = new UserFieldset($objectManager);
        $userFieldset->setUseAsBaseFieldset(true);

        // We don't want Perfil relationship, so remove it !!
        // $userFieldset->remove('perfil');

        $this->add($userFieldset);

        // … add CSRF and submit elements …

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Criar conta')->setAttribute('class', 'btn btn-lg btn-primary btn-block');
        $this->add($submit);

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-horizontal',
            'label' => 'Criar conta'
        ));

        // Optionally set your validation group here

        // $this->setInputFilter(new UserFilter());

    }

}