<?php

namespace TenilUser\Controller;


use TenilBase\Controller\CrudController;

class UsersController extends CrudController {

    public function __construct() {

        $this->controller = 'users';
        $this->entity = 'TenilUser\Entity\User';
        $this->form = 'TenilUser\Form\User';
        $this->route = 'tenil-user/default';
        $this->service = 'TenilUser\Service\User';
    }

}
