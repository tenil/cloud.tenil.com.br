<?php

/**
 * @author Roberto
 */

namespace TenilUser\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator;

class ForgotFilter extends InputFilter {

    public function __construct() {

        $emailValidator = new Validator\EmailAddress();
        $this->add(array(
            'name' => 'email',
            'required' => TRUE,
            'validators' => array($emailValidator)
        ));
    }

}
