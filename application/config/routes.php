<?php

return [

    //MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    
    'categories' => [
        'controller' => 'main',
        'action' => 'categories',
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],
    'post' => [
        'controller' => 'main',
        'action' => 'post',
    ],
    'authorization' => [
        'controller' => 'main',
        'action' => 'authorization',
    ],

    //AdminController
    'admin' => [
        'controller' => 'admin',
        'action' => 'dashboard',
    ],
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/dashboard' => [
        'controller' => 'admin',
        'action' => 'dashboard',
    ],

    //PostController
    'post/add' => [
        'controller' => 'post',
        'action' => 'add',
    ],
    'post/edit' => [
        'controller' => 'post',
        'action' => 'edit',
    ],
    'post/delete' => [
        'controller' => 'post',
        'action' => 'delete',
    ],
    
];

?>