<?php

namespace SimonMontoya;

interface AuthenticatorInterface
{

    /**
     * @return boolean
     */
    public function check();

    /**
     * @return \SimonMontoya\User
     */
    public function user();

}