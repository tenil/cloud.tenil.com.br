<?php

namespace TenilAcl\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use TenilBase\Service\AbstractService;

class Privilege extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'TenilAcl\Entity\Privilege';
    }

    public function insert(array $data) {
        $entity = new $this->entity($data);

        $role = $this->em->getReference($this->entity, $data['role']);
        $entity->setRole($role);

        $resource = $this->em->getReference($this->entity, $data['resource']);
        $entity->setResource($resource);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);

        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $role = $this->em->getReference($this->entity, $data['role']);
        $entity->setRole($role);

        $resource = $this->em->getReference($this->entity, $data['resource']);
        $entity->setResource($resource);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
