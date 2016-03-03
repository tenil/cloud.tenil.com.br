<?php

namespace TenilEvento;

return array(
    'router' => array(
        'routes' => array(
            'tenil-evento' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/eventos',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilEvento\Controller',
                        'module' => 'TenilEvento',
                        'controller' => 'eventos',
                        'action' => 'list'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:action[/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'id' => '\d+',
                            ),
                        ),
                    ),
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                //'id' => '\d+'
                                'id' => '[a-zA-Z][a-zA-z0-9_-]*'
                            )
                        ),
                    ),
                ),
            ),
            'tenil-inscricao' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/inscricoes',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilEvento\Controller',
                        'module' => 'TenilEvento',
                        'controller' => 'inscricoes',
                        'action' => 'list'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:action[/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'id' => '\d+',
                            ),
                        ),
                    ),
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        ),
                    ),
                ),
            ),
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'TenilEvento\Controller\Eventos' => 'TenilEvento\Controller\EventosController',
            'TenilEvento\Controller\Inscricoes' => 'TenilEvento\Controller\InscricoesController',
        )
    ),
    'view_manager' => array(
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
);