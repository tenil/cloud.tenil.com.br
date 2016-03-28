<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 12/02/2016
 * Time: 15:54
 */

namespace TenilEvento\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\ElementInterface;
use Zend\Form\Form;
use Zend\Form\Element;

class EventoEdit extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('evento-edit');

        // The form will hydrate an object of type "Evento"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $eventoFieldset = new EventoFieldset($objectManager);
        $eventoFieldset->setUseAsBaseFieldset(true);
        $this->add($eventoFieldset);

        // … add CSRF and submit elements …

        $security = new Element\Csrf('security');
        $this->add($security);

        $submit = new Element\Submit('submit');
        $submit->setValue('Salvar')->setAttribute('class', 'btn btn-default');
        $this->add($submit);

        $this->setAttributes(array(
            'method' => 'post',
            'role' => 'form',
            'class' => 'form-horizontal',
        ));
        
        $this->setLabel('Editar evento');

        // Optionally set your validation group here
    }

    public function setOption($key, $value)
    {
        // TODO: Implement setOption() method.
    }
}