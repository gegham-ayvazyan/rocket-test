<?php
namespace Actions;

use RocketSled\Runnable;

class Index implements Runnable
{
    public function run()
    {
        $view = view('test', 'RocketSled Test');
        $view->setValue('.who', 'John Doe');
        echo $view;
//        echo "Homepage";
    }
}