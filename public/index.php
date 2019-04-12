<?php
use SimonMontoya\Container;

require(__DIR__.'/../bootstrap/start.php');

function homeController()
{
    $access = Container::getInstance()->access();

    view('index', compact('access'));
}

homeController();