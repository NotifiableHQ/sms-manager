<?php

namespace Notifiable\SmsManager\Events;

use Notifiable\SmsManager\Message;

class MessageSending
{
    public function __construct(
        public Message $message
    ) {
    }
}
