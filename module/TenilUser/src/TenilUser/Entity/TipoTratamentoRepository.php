<?php

/**
 * @author Roberto
 */

namespace TenilUser\Entity;

use Doctrine\ORM\EntityRepository;

class TipoTratamentoRepository extends EntityRepository {

    public function fetchTratamento() {
        $entities = $this->findAll();
        $array = array();

        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getNome();
        }

        return $array;
    }

}
