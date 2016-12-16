<?php
$slugConstraints = '[\w_-]+';
$pagenumberChild = array(
    'type' => 'segment',
    'options' => array(
        'route' => '/page/:page',
        'constraints' => array(
            'page' => '\d+'
        ),
        'defaults' => array(
            'page' => 1
        )
    )
);
return array(
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/blog',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'index',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'pagenumber' => $pagenumberChild,
                    'post' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:slug',
                            'constraints' => array(
                                'slug' => $slugConstraints
                            ),
                            'defaults' => array(
                                'action' => 'view',
                                'slug' => ''
                            )
                        )
                    ),
                    'tag' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/tag/:slug',
                            'constraints' => array(
                                'slug' => $slugConstraints
                            ),
                            'defaults' => array(
                                'action' => 'tag',
                                'slug' => ''
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pagenumber' => $pagenumberChild
                        )
                    ),
                    'category' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/category/:slug',
                            'constraints' => array(
                                'slug' => $slugConstraints
                            ),
                            'defaults' => array(
                                'action' => 'category',
                                'slug' => ''
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pagenumber' => $pagenumberChild
                        )
                    ),
                    'date' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:year/:month',
                            'constraints' => array(
                                'year' => '\d{4}',
                                'month' => '\d{2}'
                            ),
                            'defaults' => array(
                                'action' => 'date',
                                'year' => '',
                                'month' => ''
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pagenumber' => $pagenumberChild
                        )
                    ),
                    'search' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/search/:keyword',
                            'constraints' => array(
                                'keyword' => '.+'
                            ),
                            'defaults' => array(
                                'action' => 'search',
                                'keyword' => ''
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pagenumber' => $pagenumberChild
                        )
                    )
                )
            ),
        ),
    ),
);