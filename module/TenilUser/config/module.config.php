<?php

namespace TenilUser;

return array(
    'router' => array(
        'routes' => array(
            'tenil-user' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilUser\Controller',
                        'module' => 'TenilUser',
                        'controller' => 'user',
                        'action' => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'id' => '[a-zA-z0-9_-]*',
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/page/[:page]',
                            'constraints' => array(
                                'page' => '\d+',
                            ),
                        )
                    ),
                ),
            ),
            'tenil-auth' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilUser\Controller',
                        'module' => 'TenilUser',
                        'controller' => 'auth',
                        'action' => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
            'tenil-perfil' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/perfil',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilUser\Controller',
                        'module' => 'TenilUser',
                        'controller' => 'profile',
                        'action' => 'detail',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'id' => '[a-zA-z0-9_-]*',
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/page/[:page]',
                            'constraints' => array(
                                'page' => '\d+',
                            ),
                        )
                    ),
                ),
            ),

            /*
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
                    'detail' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/detail',
                            'defaults' => array(
                                'action' => 'detail'
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
                    'edit' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/edit',
                            'defaults' => array(
                                'action' => 'edit'
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
            */






        )
    ),
    'controllers' => array(
        'invokables' => array(
            'TenilUser\Controller\Index' => 'TenilUser\Controller\IndexController',
            'TenilUser\Controller\User' => 'TenilUser\Controller\UserController',
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
                'credential_Callable' => function ($identity, $credential) {
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
