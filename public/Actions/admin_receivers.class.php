<?php
namespace Actions;

use RocketSled\Runnable;

class AdminReceivers implements Runnable
{
    public function run()
    {
        $view = view('admin-receivers', 'Receivers');


        $data = \Plusql::from(DB_CONNECTION_NAME)
            ->receiver
            ->sent_message
            ->user
            ->select('*')
            ->run();
        $node = $view->repeat('.receivers');
        $empty = true;
        if ($data->nextRow()) {
            $empty = false;
            foreach ($data->receiver as $receiver) {
                $node->setValue('.receiver-email', $receiver->receiver_email);
                $users = [];
                foreach ($receiver->sent_message as $sent_message) {
                    $users[$sent_message->user_id] = $sent_message->user->user_name;
                }
                $node->setValue('.receiver-contacts', implode(', ', $users));
                $node->next();
            }
        }
        $view->remove($empty ? '.receivers' : '.no-receivers');
        echo $view;
    }
}