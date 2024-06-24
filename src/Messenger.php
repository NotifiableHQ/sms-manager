<?php

namespace Notifiable\SmsManager;

use Notifiable\SmsManager\Contracts\Client;
use Notifiable\SmsManager\Events\MessageSending;
use Notifiable\SmsManager\Events\MessageSent;
use Illuminate\Contracts\Events\Dispatcher;

class Messenger
{
    protected ?string $from = null;

    protected string $to;

    protected string $message;

    public function __construct(
        protected Client $client,
        protected ?Dispatcher $events = null
    ) {
    }

    public function from(?string $from): static
    {
        $this->from = $from;

        return $this;
    }

    public function to(string $to): static
    {
        $this->to = $to;

        return $this;
    }

    public function message(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    private function makeMessage(): Message
    {
        return new Message(
            from: $this->from,
            to: $this->to,
            message: $this->message
        );
    }

    public function send(): SentMessage
    {
        $message = $this->makeMessage();

        $this->events?->dispatch(new MessageSending($message));

        $sentMessage = $this->client->send($message);

        $this->events?->dispatch(new MessageSent($sentMessage));

        return $sentMessage;
    }
}
