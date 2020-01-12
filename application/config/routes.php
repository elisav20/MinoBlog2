<?php

return [

    //MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'main/index/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'login' => [
        'controller' => 'main',
        'action' => 'login',
    ],

    'register' => [
        'controller' => 'main',
        'action' => 'register',
    ],

    'logout' => [
        'controller' => 'main',
        'action' => 'logout',
    ],

    'profile/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'profile',
    ],
    
    'categories' => [
        'controller' => 'main',
        'action' => 'categories',
    ],
    'category/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'category',
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],
    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post',
    ],
    'add' => [
        'controller' => 'main',
        'action' => 'add',
    ],
    'edit/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'edit',
    ],
    'delete/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'delete',
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
    'admin/users/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'users',
    ],
    'admin/deleteuser/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'deleteuser',
    ],
    'admin/posts/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],
    'admin/categories' => [
        'controller' => 'admin',
        'action' => 'categories',
    ],
    'admin/post/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'post',
    ],
    'admin/deletecategory/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'deletecategory',
    ],
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],
    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],
    
];

?>