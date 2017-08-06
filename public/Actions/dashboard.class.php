<?php
namespace Actions;

use Middleware\Auth;
use RocketSled\Runnable;

class Dashboard implements Runnable
{
    use Auth;

    public function run()
    {
        $view = view('dashboard', 'My Messages');
        $data = \Plusql::from(DB_CONNECTION_NAME)
            ->message
            ->sent_message
            ->receiver
            ->select('*')
            ->where('user_id = "' . $_SESSION['uid'] . '"')
            ->run();
        $node = $view->repeat('.message-row');
        while ($message = $data->nextRow())
        {
//            var_dump($message);
//            dd($message);
            $node->setValue('.message-id', $message['message_id']);
            $node->setValue('.message-text', $message['message_text']);
            $node->setValue('.message-type', $message['message_type']);
            $node->setValue('.message-receiver', $message['message_text']);
            $node->next();
        }
//        foreach ($data as $item) {
//            dd(213);
//            echo $item->message_text;
//        }
        echo $view;
    }
}