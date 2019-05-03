<?php




require(__DIR__.'/../bootstrap/start.php');

function studentController()
{
    //$access = Container::getInstance()->make('access');
    if (!Access::check('student')) {
        abort404();
    }

    view('students');
}

return studentController();