<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
        		'Album\Controller\Auth' => 'Album\Controller\AuthController',
        ),
    ),

     
    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/album[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ),
                ),
            ),
            'auth' => array(
            	'type'    => 'segment',
            	'options' => array(
            		'route'    => '/auth[/][:action]',
            		'constraints' => array(
            			'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            								
            		),// ferme constraints
            		'defaults' => array(
            			'controller' => 'Album\Controller\Auth',
            			'action'     => 'index',
            		),//ferme defaults
    	        ),//ferme options
            ),//ferme auth
            //insertion nouvelle entrée 
        ),//ferme routes
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);