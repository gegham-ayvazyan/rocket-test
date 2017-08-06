<?php
namespace Actions;

use RocketSled\Runnable;

class Register implements Runnable
{
    public function run()
    {
        if (!empty($_POST)) {
            var_dump($_POST);
        } else {
            $view = view('register', 'Sign Up');
            echo $view;
        }
    }
}