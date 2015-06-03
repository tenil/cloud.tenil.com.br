<?php

namespace TenilEvento;

return array(
    'controllers' => array(
        'invokables' => array(
            'TenilEvento\Controller\Evento' => 'TenilEvento\Controller\EventoController',
        )
    ),
    'router' => array(
        'routes' => array(
            'tenil-evento' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/evento',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilEvento\Controller',
                        'module' => 'TenilEvento',
                        'controller' => 'evento',
                        'action' => 'list'
                    )
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
                )
            )
        ),
    )
);