<?php

/**
 * @author Roberto
 */

namespace TenilAcl\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator;

class ResourceFilter extends InputFilter {

    public function __construct() {

        $nomeValidator = new Validator\NotEmpty();
        $this->add(array(
            'name' => 'nome',
            'required' => TRUE,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array($nomeValidator),
        ));
    }

}
