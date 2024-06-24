<?php

namespace Notifiable\SmsManager\Clients;

use Notifiable\SmsManager\Contracts\Client as SmsClient;
use Notifiable\SmsManager\Message;
use Notifiable\SmsManager\SentMessage;
use Psr\Http\Client\ClientExceptionInterface;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\Client\Exception\Exception;
use Vonage\SMS\Message\SMS;

class VonageClient implements SmsClient
{
    protected Client $client;

    public function __construct(
        protected string $apiKey,
        protected string $apiSecret,
        protected string $from
    ) {
        $this->client = new Client(new Basic($this->apiKey, $this->apiSecret));
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    #[\Override]
    public function send(Message $message): SentMessage
    {
        $from = $message->from() ?? $this->from;

        $vonageMessage = $this->client->sms()->send(
            new SMS($message->to(), $from, $message->message())
        );

        return new SentMessage(
            id: $vonageMessage->current()->getMessageId(),
            from: $from,
            to: $message->to(),
            message: $message->message()
        );
    }
}
