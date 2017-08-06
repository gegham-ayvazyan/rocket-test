<?php
namespace Actions;

use Middleware\Guest;
use RocketSled\Runnable;

class AdminAuth implements Runnable
{
    use Guest;

    public function run()
    {
        $view = view('admin-auth', 'Admin Authentication');
        if (isset($_POST['god-name']) && isset($_POST['what-we-say'])) {
            if ('Not Today' == $_POST['what-we-say'] && 'Death' == $_POST['god-name']) {
                $_SESSION['admin'] = true;
                redirect('AdminDashboard');
            } else {
                $view->remove('#default');
                echo $view;
            }
        } else {
            $view->remove('#fail');
            echo $view;
        }
    }
}