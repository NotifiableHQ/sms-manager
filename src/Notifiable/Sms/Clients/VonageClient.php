<?php

namespace Notifiable\Sms\Clients;

use InvalidArgumentException;
use Notifiable\Contracts\Client as SmsClient;
use Notifiable\Sms\Message;
use Notifiable\Sms\SentMessage;
use Psr\Http\Client\ClientExceptionInterface;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\Client\Exception\Exception;
use Vonage\SMS\Message\SMS;

class VonageClient implements SmsClient
{
    protected Client $client;

    public function __construct(
        protected string  $key,
        protected string  $secret,
        protected ?string $from = null
    ) {
        $this->client = new Client(new Basic($this->key, $this->secret));
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    #[\Override]
    public function send(Message $message): SentMessage
    {
        $from = $message->from() ?? $this->from;

        if (is_null($from)) {
            throw new InvalidArgumentException('From number is required');
        }

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
