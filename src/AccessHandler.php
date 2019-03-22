<?php
namespace SimonMontoya;

class AccessHandler
{
    public static function check($role)
    {
        return 'admin' === $role;
    }
    
}
