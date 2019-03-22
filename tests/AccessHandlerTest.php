<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 22/03/19
 * Time: 03:02 PM
 */

use SimonMontoya\AccessHandler as Access;


class AccessHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_grant_access()
    {
        $this->assertTrue(
            Access::check('admin')
        );
    }

    public function test_deny_access()
    {
        $this->assertFalse(
            Access::check('editor')
        );
    }
}