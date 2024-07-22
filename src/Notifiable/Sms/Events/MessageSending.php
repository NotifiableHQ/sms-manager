<?php

namespace Notifiable\Sms\Events;

use Notifiable\Sms\Message;

class MessageSending
{
    public function __construct(
        public Message $message
    ) {}
}
