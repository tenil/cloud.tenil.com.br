<?php

namespace TenilPagamento\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class PagSeguroFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // TODO: Implement createService() method.

        $config = $serviceLocator->get('config');

        $PagSeguroConfig = $config['PagSeguro'];

        return $PagSeguroConfig;

    }

}