<?php
namespace Actions;

use RocketSled\Runnable;

class Login implements Runnable
{
    public function run()
    {
        if (!empty($_POST)) {
            var_dump($_POST);
        } else {
            $view = view('login', 'Login');
            echo $view;
        }
    }
}