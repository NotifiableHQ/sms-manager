<?php

namespace Notifiable\SmsManager\Events;

use Notifiable\SmsManager\SentMessage;

class MessageSent
{
    public function __construct(
        public SentMessage $message
    ) {
    }
}
