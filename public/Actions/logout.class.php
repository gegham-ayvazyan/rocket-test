<?php
namespace Actions;

use RocketSled\Runnable;

class Logout implements Runnable
{
    public function run()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['admin']);
        session_destroy();
        redirect('Index');
    }
}