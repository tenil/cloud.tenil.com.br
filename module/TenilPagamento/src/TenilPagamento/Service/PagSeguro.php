<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 11/04/2016
 * Time: 14:19
 */

namespace TenilPagamento\Service;

use Zend\ServiceManager\ServiceManager;
use PagSeguroAccountCredentials;

class PagSeguro
{

    public function getAccountCredentials()
    {
        $serviceManager = new ServiceManager();
        // $serviceManager->setFactory('PagSeguro', 'TenilPagamento\Factory\PagSeguroFactory');
        $config = $serviceManager->get('config');

        if (isset($data['credentials']) &&
            isset($data['credentials']['email']) &&
            isset($data['credentials']['token'][$data['environment']])
        ) {
            return new PagSeguroAccountCredentials(
                $data['credentials']['email'],
                $data['credentials']['token'][$data['environment']]
            );
        } else {
            throw new Exception("Credentials not set.");
        }
    }

}