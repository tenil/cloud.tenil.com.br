<?php

namespace TenilAcl\Acl;

use TenilBase\Service\Service;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Builder extends Service
{
    /**
     * @return Acl
     */
    public function build()
    {
        $config = $this->getServiceLocator()->get('Config');
        $acl = new Acl();
        foreach ($config['acl']['roles'] as $role => $parent) {
            $acl->addRole(new Role($role), $parent);
        }
        foreach ($config['acl']['resources'] as $r) {
            $acl->addResource(new Resource($r));
        }
        foreach ($config['acl']['privileges'] as $role => $privilege) {
            if (isset($privilege['allow'])) {
                foreach ($privilege['allow'] as $p) {
                    $acl->allow($role, $p);
                }
            }
            if (isset($privilege['deny'])) {
                foreach ($privilege['deny'] as $p) {
                    $acl->deny($role, $p);
                }
            }
        }
        return $acl;
    }
}