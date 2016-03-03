<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 12/02/2016
 * Time: 12:27
 */

namespace TenilEvento\Form;

use TenilEvento\Entity\Evento;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class EventoFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('evento');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Evento());

        $this->setLabel('Evento');

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
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'tema',
            'options' => array(
                'label' => 'Tema'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'descricao',
            'options' => array(
                'label' => 'Descrição',

            ),
            'attributes' => array(
                'rows' => 3
            )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Date',
                'name' => 'dataInicio',
                'options' => array(
                    'label' => 'Data de início',
                    'format' => 'd-m-Y'
                ),
                'attributes' => array(
                    'min' => '01-01-2016',
                    'max' => '01-01-2020',
                    'step' => '1', // days; default step interval is 1 day
                )
            )

        );

        $this->add(array(
                'type' => 'Zend\Form\Element\Date',
                'name' => 'dataFim',
                'options' => array(
                    'label' => 'Data de encerramento',
                    'format' => 'd-m-Y'
                ),
                'attributes' => array(
                    'min' => '01-01-2016',
                    'max' => '01-01-2020',
                    'step' => '1', // days; default step interval is 1 day
                )
            )
        );

        $this->add(array(
                'type' => 'Zend\Form\Element\Time',
                'name' => 'horaInicio',
                'options' => array(
                    'label' => 'Hora de início',
                    'format' => 'H:i'
                ),
                'attributes' => array(
                    'min' => '00:00',
                    'max' => '23:59',
                    'step' => '60', // seconds; default step interval is 60 seconds
                )
            )
        );

        $this->add(array(
                'type' => 'Zend\Form\Element\Time',
                'name' => 'horaFim',
                'options' => array(
                    'label' => 'Hora de encerramento',
                    'format' => 'H:i'
                ),
                'attributes' => array(
                    'min' => '00:00',
                    'max' => '23:59',
                    'step' => '60', // seconds; default step interval is 60 seconds
                )
            )
        );

        $this->add(array(
            'type' => 'Zend\Form\Element\Number',
            'name' => 'qtdVagas',
            'options' => array(
                'label' => 'Número de vagas'
            ),
            'attributes' => array(
                'min' => '0',
                'max' => '10000',
                'step' => '1', // default step interval is 1
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'flagInscricoesAbertas',
            'options' => array(
                'label' => 'Inscrições abertas',
                'use_hidden_element' => true,
                'checked_value' => true,
                'unchecked_value' => 0
            ),
            'attributes' => array(
                'value' => true
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'flagEventoGratuito',
            'options' => array(
                'label' => 'Evento gratuito',
                'use_hidden_element' => true,
                'checked_value' => true,
                'unchecked_value' => false
            ),
            'attributes' => array(
                'value' => true
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'organizador', //produtor
            'options' => array(
                'label' => 'Organizador ou Produtor'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'E-mail para contato'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Number',
            'name' => 'valorInscricao',
            'options' => array(
                'label' => 'Valor da inscrição'
            ),
            'attributes' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1', // default step interval is 1
            )
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'nome' => array(
                'required' => true
            ),
            'dataFim' => array(
                'required' => true
            ),
            'dataInicio' => array(
                'required' => true
            ),
            'descricao' => array(
                'required' => false
            ),
            'email' => array(
                'required' => false
            ),
            'flagEventoGratuito' => array(
                'required' => false
            ),
            'flagInscricoesAbertas' => array(
                'required' => false
            ),
            'horaFim' => array(
                'required' => false
            ),
            'horaInicio' => array(
                'required' => false
            ),
            'organizador' => array(
                'required' => false
            ),
            'qtdVagas' => array(
                'required' => false
            ),
            'tema' => array(
                'required' => false
            ),
            'valorInscricao' => array(
                'required' => false
            ),
        );

    }

    public function setOption($key, $value)
    {
        // TODO: Implement setOption() method.
    }
}