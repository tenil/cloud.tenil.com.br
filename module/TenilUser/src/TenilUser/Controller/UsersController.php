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
        
    }
    
}
