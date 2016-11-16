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
        'name' => 'cb.org.br',
        'host' => 'email-smtp.us-east-1.amazonaws.com',
        'port' => 587, // Notice port change for TLS is 587
        'connection_class' => 'plain',
        'connection_config' => array(
            'username' => 'AKIAJAMPI6DUW2Q3NKXQ',
            'password' => 'AnVUfCSfFRehspon2MVhumYm5U5n0cZd1oXIqAi7t6ka',
            'ssl' => 'tls',
            'from' => 'arcanjo@tenil.com.br',
            'sender' => 'Arcanjo Project'
        )
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Eventos',
                'route' => 'tenil-evento',
                'pages' => array(
                    array(
                        'label' => 'Listar',
                        'route' => 'tenil-evento/default',
                        'action' => 'list'
                    ),
                    array(
                        'label' => 'Novo',
                        'route' => 'tenil-evento/default',
                        'action' => 'create',
                    ),
                ),
            ),
            array(
                'label' => 'Usuários',
                'route' => 'tenil-user/default',
                'action' => 'list'
            ),
            array(
                'label' => 'ACL',
                'route' => 'tenil-acl-admin/default',
                'controller' => 'roles',
                'action' => 'index',
                'pages' => array(
                    array(
                        'label' => 'Papéis',
                        'route' => 'tenil-acl-admin/default',
                        'controller' => 'roles',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Novo',
                                'route' => 'tenil-acl-admin/default',
                                'controller' => 'roles',
                                'action' => 'add',
                            ),
                        ),
                    ),
                    array(
                        'label' => 'Recursos',
                        'route' => 'tenil-acl-admin/default',
                        'controller' => 'resources',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Novo',
                                'route' => 'tenil-acl-admin/default',
                                'controller' => 'resources',
                                'action' => 'add',
                            ),
                        ),
                    ),
                    array(
                        'label' => 'Privilégios',
                        'route' => 'tenil-acl-admin/default',
                        'controller' => 'privileges',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Novo',
                                'route' => 'tenil-acl-admin/default',
                                'controller' => 'privileges',
                                'action' => 'add',
                            ),
                        ),
                    ),
                ),
            )
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);