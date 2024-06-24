<?php

namespace Notifiable\SmsManager\Contracts;

use Notifiable\SmsManager\Message;
use Notifiable\SmsManager\SentMessage;

interface Client
{
    public function send(Message $message): SentMessage;
}
