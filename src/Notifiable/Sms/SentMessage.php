<?php

namespace Notifiable\Sms;

class SentMessage
{
    public function __construct(
        protected string $id,
        protected string $from,
        protected string $to,
        protected string $message
    ) {}
}
