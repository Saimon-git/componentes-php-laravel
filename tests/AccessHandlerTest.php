<?php

use SimonMontoya\AccessHandler as Access;
use SimonMontoya\Authenticator;
use SimonMontoya\AuthenticatorInterface;
use SimonMontoya\User;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \SimonMontoya\AccessHandler
     */
    protected $access;

    /**
     * This method is executed BEFORE each test method
     */
    protected function setUp()
    {
        $this->access = new Access($this->getAuthenticatorMock());
    }

    /**
     * This method is executed AFTER each test method
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    public function test_grant_access()
    {
        $this->assertTrue(
            $this->access->check('admin')
        );
    }

    public function test_deny_access()
    {
        $this->assertFalse(
            $this->access->check('editor')
        );
    }

    
    /**
     * Should return TRUE because our is an admin
     */
    public function test_grant_access_with_more_than_one_role()
    {
        $this->assertTrue(
            $this->access->check(['admin', 'superadmin'])
        );
    }

    /**
     * Should return FALSE because our user is neither and editor nor a user
     */
    public function test_deny_access_with_more_than_one_role()
    {
        $this->assertFalse(
            $this->access->check(['editor', 'user'])
        );
    }

    /**
     * Should accept strings divided by " | "
     */
    public function test_allow_pipe_character()
    {
        $this->assertTrue(
            $this->access->check('admin|superadmin'),
            'It should accept a string divided by the pipe character " | "'
        );
    }

    protected function getAuthenticatorMock()
    {
        $user = Mockery::mock(User::class);
        $user->role = 'admin';

        $auth = Mockery::mock(Authenticator::class);
        $auth->shouldReceive('check')
            ->once()
            ->andReturn(true);
        $auth->shouldReceive('user')
            ->once()
            ->andReturn($user);

        return $auth;
    }

}