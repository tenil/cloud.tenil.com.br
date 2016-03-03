<?php

/**
 * @author Roberto
 */

namespace TenilEvento\Service;

use Doctrine\ORM\EntityManager;
use TenilBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Evento extends AbstractService
{
    public function __construct(EntityManager $em) {
        // Executa o método contrutor da classe pai.
        parent::__construct($em);
        $this->entity = 'TenilEvento\Entity\Evento';
    }
}
