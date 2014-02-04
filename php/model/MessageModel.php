<?php
/**
 * Created by PhpStorm.
 * User: Olaoye Adeyemi
 * Date: 2/4/14
 * Time: 10:32 AM
 * To change this template use File | Settings | File Templates.
 */

class MessageModel extends BaseModel
{

    public function send($text, $recipient, $sender)
    {
        $message_id = $this->add(Messages::SEND, array($text, $recipient, $sender));
        return $message_id;
    }

    public function getMessagesBelow($last_time, $recipient)
    {
        return $this->getAllByParam(Messages::GET_MESSAGES_BELOW, array($recipient, $last_time));
    }

} 