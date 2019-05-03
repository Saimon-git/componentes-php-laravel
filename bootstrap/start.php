<?php


use SimonMontoya\Container;

use SimonMontoya\Application;

require __DIR__ . '/../vendor/autoload.php';

class_alias('SimonMontoya\Facades\Access', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Container::getInstance();

\SimonMontoya\Facades\Access::setContainer($container);

$application = new Application($container);

//$application->register();

$application->registerProviders(array(
    SimonMontoya\Providers\SessionProvider::class,
    SimonMontoya\Providers\AuthenticatorProvider::class,
    SimonMontoya\Providers\AuthorizationProvider::class
));

