<?php
namespace Actions;

use Middleware\Admin;
use RocketSled\Runnable;

class AdminDashboard implements Runnable
{
    use Admin;

    public function run()
    {
        $view = view('admin-dashboard', 'Users');


        $data = \Plusql::from(DB_CONNECTION_NAME)
            ->user
            ->sent_message
            ->receiver
            ->select('*')
            ->run();
        $node = $view->repeat('.user-contacts');
        $empty = true;
        if ($data->nextRow()) {
            $empty = false;
            foreach ($data->user as $user) {
                $node->setValue('.user-name', $user->user_name);
                $receivers = [];
                foreach ($user->sent_message as $sent_message) {
                    $receivers[$sent_message->receiver_id] = $sent_message->receiver->receiver_email;
                }
                $node->setValue('.receiver-names', implode(', ', $receivers));
                $node->next();
            }
        }
        $view->remove($empty ? '.user-contacts' : '.no-user-contacts');
        echo $view;
    }
}