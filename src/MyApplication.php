<?php


namespace SimonMontoya;


class MyApplication extends Application
{
    protected function registerAccessHandler()
    {
        exit('Custom access handler');
    }

}