<?php

namespace TenilAcl;

return array(
    'router' => array(
        'routes' => array(
            'tenil-acl-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/acl',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilAcl\Controller',
                        'controller' => 'roles',
                        'action' => 'Index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'contronller' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'id' => '\d+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'TenilAcl\Controller',
                                'controller' => 'roles',
                            )
                        )
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/page/:page]]',
                            'constraints' => array(
                                'contronller' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'page' => '\d+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'TenilAcl\Controller',
                                'controller' => 'roles',
                            )
                        )
                    )
                )
            ),
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'TenilAcl\Controller\Roles' => 'TenilAcl\Controller\RolesController',
            'TenilAcl\Controller\Resources' => 'TenilAcl\Controller\ResourcesController',
            'TenilAcl\Controller\Privileges' => 'TenilAcl\Controller\PrivilegesController',
        )
    ),
    'view_manager' => array(
        // O módulo pode ter um layout específico
        /*
          'display_not_found_reason' => true,
          'display_exceptions'       => true,
          'doctype'                  => 'HTML5',
          'not_found_template'       => 'error/404',
          'exception_template'       => 'error/index',
          'template_map' => array(
          'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
          'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
          'error/404'               => __DIR__ . '/../view/error/404.phtml',
          'error/index'             => __DIR__ . '/../view/error/index.phtml',
          ),
         */
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    'data-fixture' => array(
        'TenilAcl_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture'
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format' => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string' => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        )
    )
);
