<?php

namespace Notifiable\SmsManager;

class Message
{
    public function __construct(
        protected ?string $from,
        protected string $to,
        protected string $message
    ) {
    }

    public function from(): ?string
    {
        return $this->from;
    }

    public function to(): string
    {
        return $this->to;
    }

    public function message(): string
    {
        return $this->message;
    }
}
