<?php

/**
 * @author Roberto
 */

namespace TenilUser\Service;

use Doctrine\ORM\EntityManager;
use TenilBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;


class Perfil extends AbstractService {

    public function __construct(EntityManager $em) {
        // Executa o método contrutor da classe pai.
        parent::__construct($em);
        $this->entity = "TenilUser\Entity\Perfil";
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);

        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        if ($data['tratamento']) {
            $tratamento = $this->em->getReference($this->entity, $data['tratamento']);
            $entity->setTratamento($tratamento);
        } else {
            $entity->setTratamento(NULL);
        }

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
