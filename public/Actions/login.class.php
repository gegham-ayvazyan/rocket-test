<?php
namespace Actions;

use Middleware\Guest;
use RocketSled\Runnable;

class Login implements Runnable
{
    use Guest;

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