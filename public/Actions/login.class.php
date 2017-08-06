<?php
namespace Actions;

use Middleware\Guest;
use RocketSled\Runnable;

class Login implements Runnable
{
    use Guest;

    private $fields = [
        'username',
        'password'
    ];

    public function run()
    {
        if (!empty($_POST)) {
            if (!$errors = $this->validate($_POST)) {

                $e = \Plusql::escape(DB_CONNECTION_NAME);

                // check if the user with the provided username / password exists
                $data = \Plusql::from(DB_CONNECTION_NAME)->user
                    ->where("user.user_name = '{$e($_POST['username'])}' AND user.user_password = '{$e(sha1($_POST['password']))}'")
                    ->limit(1)->select('*')->run();
                if (!$user = $data->nextRow()) {
                    $errors[] = 'User with the provided username / password does not exist';
                } else {
                    $_SESSION['uid'] = $user['user_id'];
                    redirect('Dashboard');
                }
            }
        }
        $view = view('login', 'Login');
        if (!empty($errors)) {
            if ($_POST['username']) {
                $view->query("#username")->item(0)->setAttribute('value', $_POST['username']);
            }
            $item = $view->repeat('.error-message');
            foreach ($errors as $error) {
                $item->setValue('p', $error);
                $item->next();
            }
        } else {
            $view->remove('#errors');
        }
        echo $view;
    }

    private function validate($data)
    {
        $errors = [];
        foreach ($this->fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $errors[] = "$field field is required";
            }
        }
        return $errors;
    }
}