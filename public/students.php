<?php
use SimonMontoya\Container;
require(__DIR__.'/../bootstrap/start.php');

function studentController()
{
    $access = Container::getInstance()->make('access');
    if (!$access->check('student')) {
        abort404();
    }

    view('students', compact('access'));
}

return studentController();