<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 07/03/2016
 * Time: 15:59
 */

namespace TenilEvento\Form;

use TenilEvento\Entity\Inscricao;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Db\Sql\Predicate\In;
use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
use Zend\I18n\Validator\PostCode;
use Zend\InputFilter\InputFilterProviderInterface;

use Zend\Validator;
use Zend\Filter;
use TenilBase\Validator\CpfValidator;
use Zend\Form\Element;

class InscricaoFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('inscricao');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Inscricao());

        $this->setLabel('Inscrição');

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'E-mail'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'nome',
            'options' => array(
                'label' => 'Nome'
            ),
            'attributes' => array(//  'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'cpf',
            'options' => array(
                'label' => 'CPF'
            )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Date',
                'name' => 'dataNascimento',
                'options' => array(
                    'label' => 'Data de Nascimento',
                    'format' => 'd/m/Y'
                ),
                'attributes' => array(
                    'min' => '01/01/1900',
                    'max' => '01/08/2016',
                    'step' => '1', // days; default step interval is 1 day
                )
            )

        );

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'foneFixo',
            'options' => array(
                'label' => 'Fone Fixo'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'foneCelular',
            'options' => array(
                'label' => 'Fone Celular'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'logradouro',
            'options' => array(
                'label' => 'Endereço'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'numero',
            'options' => array(
                'label' => 'Número'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'bairro',
            'options' => array(
                'label' => 'Bairro'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'localidade',
            'options' => array(
                'label' => 'Cidade'
            )
        ));
        /*
                $this->add(array(
                    'type' => 'Zend\Form\Element\Text',
                    'name' => 'uf',
                    'options' => array(
                        'label' => 'UF'
                    )
                ));
        */

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'uf',
            'options' => array(
                'label' => 'Estado',
                'empty_option' => 'Selecione seu estado',
                'value_options' => array(
                    'AC' => 'AC - Acre',
                    'AL' => 'AL - Alagoas',
                    'AP' => 'AP - Amapá',
                    'AM' => 'AM - Amazonas',
                    'BA' => 'BA - Bahia',
                    'CE' => 'CE - Ceará',
                    'DF' => 'DF - Distrito Federal',
                    'ES' => 'ES - Espírito Santo',
                    'GO' => 'GO - Goiás',
                    'MA' => 'MA - Maranhão',
                    'MT' => 'MT - Mato Grosso',
                    'MS' => 'MS - Mato Grosso do Sul',
                    'MG' => 'MG - Minas Gerais',
                    'PA' => 'PA - Pará',
                    'PB' => 'PB - Paraíba',
                    'PR' => 'PR - Paraná',
                    'PE' => 'PE - Pernambuco',
                    'PI' => 'PI - Piauí',
                    'RJ' => 'RJ - Rio de Janeiro',
                    'RN' => 'RN - Rio Grande do Norte',
                    'RS' => 'RS - Rio Grande do Sul',
                    'RO' => 'RO - Rondônia',
                    'RR' => 'RR - Roraima',
                    'SC' => 'SC - Santa Catarina',
                    'SP' => 'SP - São Paulo',
                    'SE' => 'SE - Sergipe',
                    'TO' => 'TO - Tocantins',
                ),
            )
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'cep',
            'options' => array(
                'label' => 'CEP'
            )
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'nome' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 3,
                            'max' => 512
                        ),
                    ),
                ),
            ),
            'email' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
                'validators' => array(
                    new Validator\EmailAddress(),
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 4,
                            'max' => 512
                        ),
                    ),
                ),
            ),
            'cpf' => array(
                'required' => false,
                'filters' => array(
                    new Filter\Digits(),
                ),
                'validators' => array(
                    new CpfValidator(),
                )
            ),
            'dataNascimento' => array(
                'required' => true,
                'validators' => array(
                    new Validator\Date(array('format' => 'd/m/Y'))
                )
            ),
            'foneFixo' => array(
                'required' => false,
                'filters' => array(
                    new Filter\Digits()
                )
            ),
            'foneCelular' => array(
                'required' => false,
                'filters' => array(
                    new Filter\Digits()
                )
            ),
            'logradouro' => array(
                'required' => true
            ),
            'numero' => array(
                'required' => true
            ),
            'bairro' => array(
                'required' => true
            ),
            'localidade' => array(
                'required' => true
            ),
            'uf' => array(
                'required' => true
            ),
            'cep' => array(
                'required' => true,
                'filters' => array(
                    new Filter\Digits()
                ),
                'validators' => array(
                    new PostCode(array('locale' => 'pt_BR'))
                )
            ),
        );

    }

    public function setOption($key, $value)
    {
        // TODO: Implement setOption() method.
    }
}