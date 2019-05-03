<?php



require(__DIR__.'/../bootstrap/start.php');

function teacherController()
{
    //$access = Container::getInstance()->make('access');
    if (!Access::check('teacher')) {
        abort404();
    }

    view('teachers');
}

teacherController();