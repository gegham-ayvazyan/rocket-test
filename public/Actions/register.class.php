<?php
namespace Actions;

use Middleware\Guest;
use RocketSled\Runnable;

class Register implements Runnable
{
    use Guest;

    private $fields = [
        'username', 'email', 'password', 'confirm_password'
    ];
    public function run()
    {
        if (!empty($_POST)) {
            if (!$errors = $this->validate($_POST)) {

                $escape = \Plusql::escape(DB_CONNECTION_NAME);

                // check if username is already in use
                $data = \Plusql::from(DB_CONNECTION_NAME)->user
                    ->where('user.user_name = "' . $escape($_POST['username']) . '"')
                    ->select('count(*) as count')->run();
                if ($data->nextRow()['count']) {
                    $errors[] = 'Username is already in use';
                }

                // check if email is already in use
                $data = \Plusql::from(DB_CONNECTION_NAME)->user
                    ->where('user.user_email = "' . $escape($_POST['email']) . '"')
                    ->select('count(*) as count')->run();
                if ($data->nextRow()['count']) {
                    $errors[] = 'An account already exists with this email';
                }

                if (empty($errors)) {
                    $res = \Plusql::into(DB_CONNECTION_NAME)->user([
                        'user_name' => $_POST['username'],
                        'user_email' => $_POST['email'],
                        'user_password' => sha1($_POST['password']),
                        'user_created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                    ])->insert();
                    $id = $res->link()->insert_id;
                    $_SESSION['uid'] = $id;
                    redirect('Dashboard');
                }
            }
        }
        $view = view('register', 'Sign Up');
        if (!empty($errors)) {
            if ($_POST['username']) {
                $view->query("#username")->item(0)->setAttribute('value', $_POST['username']);
            }
            if ($_POST['email']) {
                $view->query("#email")->item(0)->setAttribute('value', $_POST['username']);
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

    protected function validate($data)
    {
        $errors = [];
        foreach ($this->fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $errors[] = "$field field is required";
            }
        }
        if ($data['password'] !== $data['confirm_password']) {
            $errors[] = 'Password Confirmation does not match the password';
        } else if (strlen($data['password']) < 6) {
            $errors[] = 'Password shall be at least 6 characters long';
        }
        return $errors;
    }
}