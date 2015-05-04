<?php

namespace TenilAcl\Controller;

use TenilBase\Controller\CrudController;

class ResourcesController extends CrudController {

    public function __construct() {
        $this->entity = 'TenilAcl\Entity\Resource';
        $this->service = 'TenilAcl\Service\Resource';
        $this->form = 'TenilAcl\Form\Resource';
        $this->controller = 'Resources';
        $this->route = 'tenil-acl-admin/default';
    }

}
