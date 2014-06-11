<?php

/**
 * @author Roberto
 */

namespace TenilUser\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator;

class UserFilter extends InputFilter {

    public function __construct() {

        $nomeValidator = new Validator\NotEmpty();
        $this->add(array(
            'name' => 'nome',
            'required' => TRUE,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
                array('name' => 'StringToLower')
            ),
            'validators' => array($nomeValidator),
        ));

        $emailValidator = new Validator\EmailAddress();
        $this->add(array(
            'name' => 'email',
            'required' => TRUE,
            'validators' => array($emailValidator)
        ));

        $this->add(array(
            'name' => 'password',
            'required' => TRUE,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
//                    'options' => array(
//                        'messages' => array(
//                            'isEmpty' => 'Precisa ser preenchido'
//                        ),
//                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'confirmation',
            'required' => FALSE,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password'
                    )
                ),
            ),
        ));
    }

}