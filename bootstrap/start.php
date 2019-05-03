<?php

use SimonMontoya\AccessHandler;
use SimonMontoya\Authenticator;
use SimonMontoya\SessionArrayDriver;
use SimonMontoya\SessionManager;

require __DIR__ . '/../vendor/autoload.php';

class_alias('SimonMontoya\AccessHandler', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = SimonMontoya\Container::getInstance();

$container->singleton('session', function() {

    $data = array(
        'user_data' => array(
            'name' => 'Saimon',
            'role' => 'teacher'
        )
    );

    $driver = new SessionArrayDriver($data);

    return new SessionManager($driver);
});

$container->singleton('auth', function($container) {
   return new Authenticator($container->make('session'));
});

$container->singleton('access',function($container){
    return new AccessHandler($container->make('auth'));
});

