<?php


namespace SimonMontoya\Facades;


use SimonMontoya\Container;

class Access
{
    public static function check($roles)
    {
        return Container::getInstance()->make('access')->check($roles);
    }

}