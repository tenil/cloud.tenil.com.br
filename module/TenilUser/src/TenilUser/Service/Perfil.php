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

        if ($data['fone1tipo']) {
            $fone1tipo = $this->em->getReference($this->entity, $data['fone1tipo']);
            $entity->setFone1tipo($fone1tipo);
        } else {
            $entity->setFone1tipo(NULL);
        }

        if ($data['fone2tipo']) {
            $fone2tipo = $this->em->getReference($this->entity, $data['fone2tipo']);
            $entity->setFone2tipo($fone2tipo);
        } else {
            $entity->setFone2tipo(NULL);
        }

        if ($data['fone3tipo']) {
            $fone3tipo = $this->em->getReference($this->entity, $data['fone3tipo']);
            $entity->setFone3tipo($fone3tipo);
        } else {
            $entity->setFone3tipo(NULL);
        }

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
