<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    'mail' => array(
        'name' => 'tenil.com.br',
        'host' => 'email-smtp.us-east-1.amazonaws.com',
        'port' => 587, // Notice port change for TLS is 587
        'connection_class' => 'plain',
        'connection_config' => array(
            'username' => 'AKIAIFLK4RVKZEWBW4NA',
            'password' => 'AgSiyezSIzWH7UvOSj+SM7Zs3ICg1+eAmb8CIYj/3ghr',
            'ssl' => 'tls',
            'from' => 'contato@tenil.com.br',
            'sender' => 'Tenil Tecnologia'
        )
    ),
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
            'TenilAcl\Controller\Resouces.add',
            'TenilAcl\Controller\Resouces.delete',
            'TenilAcl\Controller\Resouces.edit',
            'TenilAcl\Controller\Resouces.index',
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
                    'TenilAcl\Controller\Resouces.add',
                    'TenilAcl\Controller\Resouces.delete',
                    'TenilAcl\Controller\Resouces.edit',
                    'TenilAcl\Controller\Resouces.index',
                    'TenilAcl\Controller\Roles.add',
                    'TenilAcl\Controller\Roles.delete',
                    'TenilAcl\Controller\Roles.edit',
                    'TenilAcl\Controller\Roles.index',
                    'TenilAcl\Controller\Roles.test',
                    'TenilUser\Controller\Users.add',
                    'TenilUser\Controller\Users.delete',
                    'TenilUser\Controller\Users.edit',
                    'TenilUser\Controller\Users.index',
                )
            ),
        )
    )
);
