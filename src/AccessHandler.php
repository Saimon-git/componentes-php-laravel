<?php
namespace SimonMontoya;

use SimonMontoya\Authenticator as Auth;

class AccessHandler
{
    public static function check($role)
    {
        return Auth::check() && Auth::user()->role === $role;
    }
    
}
