<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/03/2016
 * Time: 17:24
 */

namespace TenilEvento\Form;

use Zend\Filter\File\RenameUpload;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\File\Extension;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\Size;

class RetornoFilter extends InputFilter
{

    public function __construct()
    {
        $arquivo = new FileInput('arquivo-retorno');
        $arquivo->setRequired(true);

        // Filters
        $arquivo->getFilterChain()->attach(new RenameUpload(array(
            'target' => './data/retornos/retorno_',
            'use_upload_extension' => true,
            'randomize' => true,
        )));
        $arquivo->getFilterChain()->attach(new Size(array(
            'max' => substr(ini_get('upload_max_filesize'), 0, -1) . 'MB'
        )));
        $arquivo->getFilterChain()->attach(new MimeType(array(
            'text/plain',
            'enableHeaderCheck' => true
        )));
        // Validators
        $arquivo->getValidatorChain()->attach(new Extension(array(
            'ret'
        )));

        $this->add($arquivo);
    }

}