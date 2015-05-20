<?php

/**
 * @author Roberto
 */

namespace TenilUser\Entity;

use Doctrine\ORM\EntityRepository;

class TelefoneTipoRepository extends EntityRepository {

    public function fetchTelefoneTipo() {
        $entities = $this->findAll();
        $array = array();

        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getNome();
        }

        return $array;
    }

}
