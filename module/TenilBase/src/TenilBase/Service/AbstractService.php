<?php

/**
 * @author Roberto
 */

namespace TenilBase\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

abstract class AbstractService
{

    /**
     *
     * @var EntityManager
     */
    protected $em;
    protected $entity;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    // Método utilizando uma entity
    public function insert($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    /* Método utilizando ARRAY
    public function insert(array $data)
    {
        $entity = new $this->entity($data);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    */

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);

        // Aqui aplicamos os setters da entitade.
        // (new Hydrator\ClassMethods())->hydrate($data, $entity);
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($data, $entity);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->em->getReference($this->entity, $id);

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
        }
        return $id;
    }

}