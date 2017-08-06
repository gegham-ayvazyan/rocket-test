<?php
namespace Actions;

use RocketSled\Runnable;

class Login implements Runnable
{
    public function run()
    {
        $view = view('login', 'RocketSled Test');
        echo $view;
    }
}