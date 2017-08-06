<?php
namespace Actions;

use RocketSled\Runnable;

class Index implements Runnable
{
    public function run()
    {
        $view = view('index');
        echo $view;
    }
}