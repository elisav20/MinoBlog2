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

    //AuthorizationController
    'authorization/login' => [
        'controller' => 'authorization',
        'action' => 'login',
    ],

    'authorization/register' => [
        'controller' => 'authorization',
        'action' => 'register',
    ],

    'authorization/logout' => [
        'controller' => 'authorization',
        'action' => 'logout',
    ],

    //UserController
    'user/profile/{id:\d+}' => [
        'controller' => 'user',
        'action' => 'profile',
    ],

    //CateoriesController
    'categories' => [
        'controller' => 'categories',
        'action' => 'categories',
    ],
    'category/{id:\d+}' => [
        'controller' => 'categories',
        'action' => 'category',
    ],

    //PostController
    'post/{id:\d+}' => [
        'controller' => 'post',
        'action' => 'post',
    ],
    'post/add' => [
        'controller' => 'post',
        'action' => 'add',
    ],
    'post/edit/{id:\d+}' => [
        'controller' => 'post',
        'action' => 'edit',
    ],
    'post/delete/{id:\d+}' => [
        'controller' => 'post',
        'action' => 'delete',
    ],

    //ContactController
    'contact' => [
        'controller' => 'contact',
        'action' => 'contact',
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