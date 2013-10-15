<?php

/**
 * @author Roberto
 */

namespace TenilUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

abstract class AbstractService {

    /**
     *
     * @var EntityManager
     */
    protected $em;
    protected $entity;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function insert(array $data) {
        $entity = new $this->entity($data);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->em, $data['id']);

        // Aqui aplicamos os setters da entitade.
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function delete($id) {
        $entity = $this->em->getReference($this->em, $id);

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
            return $id;
        }
    }

}