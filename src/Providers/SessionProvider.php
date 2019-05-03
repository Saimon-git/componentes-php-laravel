<?php


namespace SimonMontoya\Providers;


use SimonMontoya\SessionArrayDriver;
use SimonMontoya\SessionManager;

class SessionProvider extends Provider
{

    public function register()
    {
        $this->container->singleton('session', function() {

            $data = array(
                'user_data' => array(
                    'name' => 'Saimon',
                    'role' => 'teacher'
                )
            );

            $driver = new SessionArrayDriver($data);

            return new SessionManager($driver);
        });
    }
}