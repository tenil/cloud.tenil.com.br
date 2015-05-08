<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 07/05/2015
 * Time: 16:43
 */

namespace TenilBase\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

abstract class Service implements ServiceManagerAwareInterface {
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $locator
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}