<?php

namespace Notifiable\Contracts;

use Notifiable\Sms\Message;
use Notifiable\Sms\SentMessage;

interface Client
{
    public function send(Message $message): SentMessage;
}
