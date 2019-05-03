<?php


namespace SimonMontoya\Providers;


use SimonMontoya\Authenticator;
use SimonMontoya\AuthenticatorInterface;

class AuthenticatorProvider extends Provider
{

    public function register()
    {
        $this->container->singleton(AuthenticatorInterface::class, function($app) {
            return new Authenticator($app->make('session'));
        });
    }
}