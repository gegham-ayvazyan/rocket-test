<?php
namespace Actions;

use Middleware\Auth;
use RocketSled\Runnable;

class Dashboard implements Runnable
{
    use Auth;

    public function run()
    {
        echo view('dashboard', 'My Messages');
    }
}