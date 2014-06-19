<?php

/**
 * @author Roberto
 */

namespace TenilUser\Form;

use Zend\InputFilter\InputFilter;

class ResetFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name' => 'password',
            'required' => TRUE,
            'validators' => array(
                array(
                    'name' => 'NotEmpty'
                ),
            ),
        ));
    }

}
