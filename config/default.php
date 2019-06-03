<?php

use \JiraTasks\Core\Router;
return [
    'db' => [
        'host' => 'mysql',
        'port' => '3306',
        'user' => 'user',
        'password' => 'user_password',
    ],
    Router::CONFIG_KEY => include 'routes.php',
    'css' => [
        ['href' => ASSETS_PATH . '/bootstrap/css/bootstrap.min.css'],
        ['href' => ASSETS_PATH . '/css/main.css'],
    ],
    'js' => [
        ['src' => 'https://code.jquery.com/jquery-3.3.1.slim.min.js'],
        ['src' => ASSETS_PATH . '/bootstrap/js/bootstrap.min.js'],
        ['src' => ASSETS_PATH . '/js/main.js'],
    ],
    'meta' => [
        ['charset' => 'UTF-8'],
        ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'],
    ]
];