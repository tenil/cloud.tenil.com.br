<?php

namespace TenilAcl\Service;

use Doctrine\ORM\EntityManager;
use TenilBase\Service\AbstractService;

class Resource extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = "TenilAcl\Entity\Resource";
    }


}
