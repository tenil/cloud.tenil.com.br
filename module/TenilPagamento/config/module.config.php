<?php

namespace TenilPagamento;

return array(
    'router' => array(
        'routes' => array(
            'tenil-pagamento' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/pagamento',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TenilPagamento\Controller',
                        'module' => 'TenilPagamento',
                        'controller' => 'pagamento',
                        'action' => 'index'
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
                ),
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'TenilPagamento\Controller\Pagamento' => 'TenilPagamento\Controller\PagamentoController',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);