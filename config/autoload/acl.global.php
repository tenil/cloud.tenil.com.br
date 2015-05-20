<?php

return array(
    'acl' => array(
        'roles' => array(
            'visitante' => null,
            'registrado' => 'visitante',
            'administrador' => 'registrado'
        ),
        'resources' => array(
            'Application\Controller\Index.index',
            'TenilAcl\Controller\Privileges.add',
            'TenilAcl\Controller\Privileges.delete',
            'TenilAcl\Controller\Privileges.edit',
            'TenilAcl\Controller\Privileges.index',
            'TenilAcl\Controller\Resources.add',
            'TenilAcl\Controller\Resources.delete',
            'TenilAcl\Controller\Resources.edit',
            'TenilAcl\Controller\Resources.index',
            'TenilAcl\Controller\Roles.add',
            'TenilAcl\Controller\Roles.delete',
            'TenilAcl\Controller\Roles.edit',
            'TenilAcl\Controller\Roles.index',
            'TenilAcl\Controller\Roles.test',
            'TenilUser\Controller\Auth.login',
            'TenilUser\Controller\Auth.logout',
            'TenilUser\Controller\Index.activate',
            'TenilUser\Controller\Index.forgot',
            'TenilUser\Controller\Index.index',
            'TenilUser\Controller\Index.register',
            'TenilUser\Controller\Index.reset',
            'TenilUser\Controller\Profile.edit',
            'TenilUser\Controller\Profile.index',
            'TenilUser\Controller\Users.add',
            'TenilUser\Controller\Users.delete',
            'TenilUser\Controller\Users.edit',
            'TenilUser\Controller\Users.index',
        ),
        'privileges' => array(
            'visitante' => array(
                'allow' => array(
                    'Application\Controller\Index.index',
                    'TenilUser\Controller\Auth.login',
                    'TenilUser\Controller\Auth.logout',
                    'TenilUser\Controller\Index.activate',
                    'TenilUser\Controller\Index.forgot',
                    'TenilUser\Controller\Index.register',
                    'TenilUser\Controller\Index.reset',
                )
            ),
            'registrado' => array(
                'allow' => array(
                    'TenilUser\Controller\Profile.edit',
                    'TenilUser\Controller\Profile.index',
                )
            ),
            'administrador' => array(
                'allow' => array(
                    'TenilAcl\Controller\Privileges.add',
                    'TenilAcl\Controller\Privileges.delete',
                    'TenilAcl\Controller\Privileges.edit',
                    'TenilAcl\Controller\Privileges.index',
                    'TenilAcl\Controller\Resources.add',
                    'TenilAcl\Controller\Resources.delete',
                    'TenilAcl\Controller\Resources.edit',
                    'TenilAcl\Controller\Resources.index',
                    'TenilAcl\Controller\Roles.add',
                    'TenilAcl\Controller\Roles.delete',
                    'TenilAcl\Controller\Roles.edit',
                    'TenilAcl\Controller\Roles.index',
                    'TenilAcl\Controller\Roles.test',
                    'TenilUser\Controller\Users.add',
                    'TenilUser\Controller\Users.delete',
                    'TenilUser\Controller\Users.edit',
                    'TenilUser\Controller\Users.index',
                ),
                'deny' => array(
                    'TenilUser\Controller\Auth.login'
                ),
            ),
        )
    )
);
