<?php

namespace SimonMontoya;

use SimonMontoya\SessionManager as Session;

class Authenticator implements AuthenticatorInterface
{
    /**
     * @var \SimonMontoya\SessionManager
     */
    protected $session;

    /**
     * @var \SimonMontoya\User
     */
    protected $user;

    /**
     * @param \SimonMontoya\SessionManager $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function check()
    {
        return $this->user() != null;
    }

    public function user()
    {
        if ($this->user != null) {
            return $this->user;
        }

        $data = $this->session->get('user_data');

        if ( ! is_null($data)) {
            return $this->user = new User($data);
        }

        return null;
    }

}