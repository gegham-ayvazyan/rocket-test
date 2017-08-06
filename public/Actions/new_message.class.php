<?php
namespace Actions;

use Middleware\Auth;
use RocketSled\Runnable;

class NewMessage implements Runnable
{
    use Auth;

    private $fields = [
        'type',
        'email',
        'message',
    ];

    public function run()
    {
        if (!empty($_POST)) {
            if (!$errors = $this->validate($_POST)) {

                $e = \Plusql::escape(DB_CONNECTION_NAME);

                // check if receiver exists
                $data = \Plusql::from(DB_CONNECTION_NAME)->receiver
                    ->where("receiver_email = '{$e($_POST['email'])}'")
                    ->limit(1)->select('*')->run();
                $date = (new \DateTime())->format('Y-m-d H:i:s');
                if (!$receiver = $data->nextRow()) {
                    $res = \Plusql::into(DB_CONNECTION_NAME)->receiver([
                        'receiver_email' => $_POST['email'],
                        'receiver_created_at' => $date,
                        'receiver_last_message' => $date,
                    ])->insert();
                    $receiver_id = $res->link()->insert_id;
                } else {
                    $receiver_id = $receiver['receiver_id'];
                    \Plusql::on(DB_CONNECTION_NAME)->receiver(['receiver_created_at' => $date])
                        ->where("receiver_id = {$receiver_id}")->update();
                }
                $res = \Plusql::into(DB_CONNECTION_NAME)->message([
                    'message_text' => $_POST['message'],
                    'message_type' => $_POST['type'],
                    'message_created_at' => $date,
                ])->insert();
                $message_id = $res->link()->insert_id;
                \Plusql::into(DB_CONNECTION_NAME)->sent_message([
                    'user_id' => get_user()->id,
                    'receiver_id' => $receiver_id,
                    'message_id' => $message_id,
                ])->insert();

                redirect('Dashboard');
            }
        }
        echo view('new_message', 'New Message');
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