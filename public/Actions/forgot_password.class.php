<?php
namespace Actions;

use Middleware\Guest;
use RocketSled\Runnable;

class ForgotPassword implements Runnable
{
    use Guest;

    public function run()
    {
        $view = view('forgot-password', 'Forgot Password');
        if (isset($_POST['email']) && isset($_POST['email'])) {
            $str = "Psst! If you didn't lie to me about your email, you will be able use this password to login. But tell no one where you got it from...\n\n";
            $pass = str_random(16);
            $str .= $pass;
            $e = \Plusql::escape(DB_CONNECTION_NAME);
            \Plusql::on(DB_CONNECTION_NAME)->user(['user_password' => sha1($pass)])
                ->where("user_email = '{$e($_POST['email'])}'")->update();
            $view->setValue('.panel-body', $str);
        }
        echo $view;
    }
}