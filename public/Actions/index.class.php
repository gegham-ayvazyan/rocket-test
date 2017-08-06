<?php
namespace Actions;

use RocketSled\Runnable;

class Index implements Runnable
{
    public function run()
    {
        $view = view('index');
        if (logged_in() || is_admin()) {
            $view->remove('#login-link');
        }
        echo $view;
    }
}