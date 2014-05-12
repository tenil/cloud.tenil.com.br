<?php

/**
 * @author Roberto
 */

namespace TenilUser\Form\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as OriginalFormElementErros;

class FormElementErrors extends OriginalFormElementErros {

    protected $messageOpenFormat = '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    protected $messageSeparatorString = '</div><div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    protected $messageCloseString = '</div>';

}
