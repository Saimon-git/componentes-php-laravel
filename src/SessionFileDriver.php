<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 22/03/19
 * Time: 04:31 PM
 */

namespace SimonMontoya;


class SessionFileDriver
{
    public static function load()
    {
        $file = __DIR__ . '/../storage/session/session.json';

        if (file_exists($file)){
            return json_decode(file_get_contents($file), true);
        }

        return [];
    }

}