<?php

namespace Notifiable\Sms\Events;

use Notifiable\Sms\SentMessage;

class MessageSent
{
    public function __construct(
        public SentMessage $message
    ) {}
}
