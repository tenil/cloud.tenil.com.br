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

class PerfilUpdate extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('perfil-update');

        // The form will hydrate an object of type "Perfil"
        $this->setHydrator(new DoctrineHydrator($objectManager));
        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-horizontal',
            'label' => 'Atualizar perfil'
        ));

        // Add the user fieldset, and set it as the base fieldset
        $perfilFieldset = new PerfilFieldset($objectManager);
        $perfilFieldset->setUseAsBaseFieldset(true);
        $this->add($perfilFieldset);

        // … add CSRF and submit elements …

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Salvar')->setAttribute('class', 'btn btn-default');
        $this->add($submit);



        // Optionally set your validation group here
    }

}