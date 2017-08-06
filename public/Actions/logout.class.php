<?php
namespace Actions;

use Middleware\Auth;
use RocketSled\Runnable;

class Logout implements Runnable
{
    use Auth;

    public function run()
    {
        unset($_SESSION['uid']);
        session_destroy();
        redirect('Index');
    }
}