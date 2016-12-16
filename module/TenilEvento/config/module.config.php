<?php

namespace TenilEvento;

return array(
    'router' => array(
        'routes' => array(
            'tenil-evento' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/eventos',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilEvento\Controller',
                        'module' => 'TenilEvento',
                        'controller' => 'eventos',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/:action][/:id[/:cpf]]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-z0-9_-]*',
                                'id' => '[a-zA-z0-9_-]*',
                            ),
                        ),
                    ),
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/:slug]',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'slug' => '[a-zA-z0-9_-]*',
                            )
                        )
                    ),
                    'create' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/create',
                            'defaults' => array(
                                'action' => 'create'
                            )
                        )
                    ),
                    'list' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/list',
                            'defaults' => array(
                                'action' => 'list'
                            )
                        )
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action]/page/[:page]',
                            'constraints' => array(
                                'page' => '\d+',
                            ),
                        )
                    ),
                ),
            )
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