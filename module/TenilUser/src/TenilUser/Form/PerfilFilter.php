<?php

/**
 * @author Roberto
 */

namespace TenilUser\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator;

class PerfilFilter extends InputFilter {

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
        
        $this->add(array(
            'name' => 'tratamento',
            'required' => FALSE,
        ));
        
        $this->add(array(
            'name' => 'fone1tipo',
            'required' => FALSE,
        ));        
        
        $this->add(array(
            'name' => 'fone2tipo',
            'required' => FALSE,
        ));

        $this->add(array(
            'name' => 'fone3tipo',
            'required' => FALSE,
        ));


//        $emailValidator = new Validator\EmailAddress();
//        $this->add(array(
//            'name' => 'email',
//            'required' => TRUE,
//            'validators' => array($emailValidator),
//            'filters' => array(
//                array('name' => 'StringToLower')
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'password',
//            'required' => TRUE,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim')
//            ),
//            'validators' => array(
//                array(
//                    'name' => 'NotEmpty'
//                ),
//            ),
//        ));

//        $this->add(array(
//            'name' => 'confirmation',
//            'required' => FALSE,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim')
//            ),
//            'validators' => array(
//                array(
//                    'name' => 'NotEmpty',
//                    'name' => 'Identical',
//                    'options' => array(
//                        'token' => 'password'
//                    )
//                ),
//            ),
//        ));
    }

}
