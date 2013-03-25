<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Book\Controller\Book' => 'Book\Controller\BookController',
        ),
    ),

    // Routing:
    'router' => array(
        'routes' => array(
            'book' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/book[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Book\Controller\Book',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),    
    'view_manager' => array(
        'template_path_stack' => array(
            'book' => __DIR__ . '/../view',
        ),
    ),
);