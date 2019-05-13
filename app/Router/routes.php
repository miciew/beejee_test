<?php


return [
    '/' => [
        '_controller' => \Miciew\Controllers\IndexController::class,
        '_action' => 'index',
        '_methods' => ['GET']
    ],

    '/tasks/create' => [
        '_controller' => \Miciew\Controllers\TaskController::class,
        '_action' => 'store',
        '_methods' => ['GET', 'POST']
    ],

    '/tasks/delete' => [
        '_controller' => \Miciew\Controllers\TaskController::class,
        '_action' => 'deleteTask',
        '_methods' => ['DELETE', 'POST', 'GET']
    ],

    '/tasks/statuses/create' => [
        '_controller' => \Miciew\Controllers\TaskController::class,
        '_action' => 'statusStore',
        '_methods' => ['GET', 'POST']
    ],

    '/tasks/toogle-status' => [
        '_controller' => \Miciew\Controllers\TaskController::class,
        '_action' => 'updateTaskStatus',
        '_methods' => ['GET', 'POST']
    ],

    '/tasks/update' => [
        '_controller' => \Miciew\Controllers\TaskController::class,
        '_action' => 'updateTask',
        '_methods' => ['GET', 'POST']
    ],

    '/tasks/edit' => [
        '_controller' => \Miciew\Controllers\TaskController::class,
        '_action' => 'editeTask',
        '_methods' => ['GET', 'POST']
    ],

    '/auth' => [
        '_controller' => \Miciew\Controllers\LoginController::class,
        '_action' => 'auth',
        '_methods' => ['GET']
    ],

    '/login' => [
        '_controller' => \Miciew\Controllers\LoginController::class,
        '_action' => 'login',
        '_methods' => ['POST']
    ],

    '/logout' => [
        '_controller' => \Miciew\Controllers\LoginController::class,
        '_action' => 'logout',
        '_methods' => ['GET']
    ],

    '/register' => [
        '_controller' => \Miciew\Controllers\LoginController::class,
        '_action' => 'register',
        '_methods' => ['GET', 'POST']
    ],

    '/asd' => [
        '_controller' => function() {
            require __DIR__ . '/../../asd.php';
        },
    ]

];