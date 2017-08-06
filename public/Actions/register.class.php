<?php
namespace Actions;

use Middleware\Guest;
use RocketSled\Runnable;

class Register implements Runnable
{
    use Guest;

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