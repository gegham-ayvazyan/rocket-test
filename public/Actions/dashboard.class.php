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
            ->select('message_text, message_type, message_text, receiver_email, message_created_at')
            ->where('user_id = "' . $_SESSION['uid'] . '"')
            ->orderBy('message_created_at DESC')
            ->run();
        $node = $view->repeat('.message-row');
        $empty = true;
        while ($message = $data->nextRow())
        {
            $empty = false;
            $node->setValue('.message-text', $message['message_text']);
            $node->setValue('.message-type', $message['message_type']);
            $node->setValue('.message-receiver', $message['receiver_email']);
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $message['message_created_at'])->format('F j, Y \a\t g:ia');
            $node->setValue('.message-time', $date);
            $node->next();
        }
        $view->remove($empty ? '.message-row' : '.no-messages');
        echo $view;
    }
}