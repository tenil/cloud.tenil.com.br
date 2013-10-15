<?php

/**
 * @author Roberto
 */

namespace TenilUser\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator;

class UserFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name' => 'nome',
            'required' => TRUE,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Precisa ser preenchido'
                        ),
                    ),
                ),
            ),
        ));

        $emailValidator = new Validator\EmailAddress();
        $this->add(array(
            'name' => 'email',
            #'required' => FALSE,
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
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Precisa ser preenchido'
                        ),
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'confirmation',
            'required' => TRUE,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Precisa ser preenchido'
                        ),
                    ),
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password'
                    )
                ),
            ),
        ));
    }

}