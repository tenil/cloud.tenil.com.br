<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 07/03/2016
 * Time: 15:54
 */

namespace TenilEvento\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\ElementInterface;
use Zend\Form\Form;
use Zend\Form\Element;

class InscricaoCreate extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('inscricao-create');

        // The form will hydrate an object of type "Inscricao"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $inscricaoFieldset = new InscricaoFieldset($objectManager);
        $inscricaoFieldset->setUseAsBaseFieldset(true);
        $this->add($inscricaoFieldset);

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
            'label' => 'Fazer inscrição'
        ));

        // Optionally set your validation group here
    }

    public function setOption($key, $value)
    {
        // TODO: Implement setOption() method.
    }
}