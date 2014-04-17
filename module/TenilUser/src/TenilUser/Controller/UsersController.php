<?php

namespace TenilUser\Controller;

/**
 * Description of UsersController
 *
 * @author Roberto
 */
class UsersController extends CrudController {

    public function __construct() {

        $this->entity = 'TenilUser\Entity\User';
        $this->form = 'TenilUser\Form\User';
        $this->service = 'TenilUser\Service\User';
        $this->controller = 'Users';
        $this->route = 'tenil-user-admin/default';
    }

}
