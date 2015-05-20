<?php

namespace TenilUser;

return array(
    'router' => array(
        'routes' => array(
            'tenil-user' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilUser\Controller',
                        'module' => 'TenilUser',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Index',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(//permite mandar dados pela url 
                            'wildcard' => array(
                                'type' => 'Wildcard'
                            ),
                        ),
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
                                '__NAMESPACE__' => 'TenilUser\Controller',
                                'controller' => 'users',
                            )
                        )
                    )
                ),
            ),
            'perfil' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/perfil',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilUser\Controller',
                        'module' => 'TenilUser',
                        'controller' => 'profile',
                        'action' => 'list'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'datail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/create',
                            'defaults' => array(
                                'action' => 'create'
                            ),
                        ),
                    ),
                    'update' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/update/:id',
                            'defaults' => array(
                                'action' => 'update'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'action' => 'update'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            ),
                        ),
                    ),

                ),
            ),
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'TenilUser\Controller\Index' => 'TenilUser\Controller\IndexController',
            'TenilUser\Controller\Users' => 'TenilUser\Controller\UsersController',
            'TenilUser\Controller\Auth' => 'TenilUser\Controller\AuthController',
            'TenilUser\Controller\Profile' => 'TenilUser\Controller\ProfileController',
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
                ),
            )
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'TenilUser\Entity\User',
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_Callable' => function($identity, $credential) {
                    return $identity->encryptPassword($credential);
                },
            ),
        ),
    ),
    'data-fixture' => array(
        'TenilUser_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture'
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format' => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string' => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        ),
    ),


);
