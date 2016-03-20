<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 18/03/2016
 * Time: 10:57
 */

namespace TenilBase\Filter;

use Zend\filter\FilterInterface;

class DataFilter implements FilterInterface
{

    public function filter($value)
    {
        $data = \DateTime::createFromFormat('d/m/Y', $value);
        return $data;
    }

}