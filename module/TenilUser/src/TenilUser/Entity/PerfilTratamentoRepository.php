<?php

/**
 * @author Roberto
 */

namespace TenilUser\Entity;

use Doctrine\ORM\EntityRepository;

class PerfilTratamentoRepository extends EntityRepository {

    public function fetchPerfilTratamento() {
        $entities = $this->findAll();
        $array = array();

        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getNome();
        }

        return $array;
    }

}
