<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/03/2016
 * Time: 14:02
 */

namespace TenilEvento\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;


class Evento extends Form implements ObjectManagerAwareInterface
{

    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }

    public function setOption($key, $value)
    {
        // TODO: Implement setOption() method.
    }

}
