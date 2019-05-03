<?php


namespace SimonMontoya\Providers;


use SimonMontoya\AccessHandler;

class AuthorizationProvider extends Provider
{

    public function register()
    {
        $this->container->singleton('access',function($app){
            return $app->build(AccessHandler::class);
        });
    }
}