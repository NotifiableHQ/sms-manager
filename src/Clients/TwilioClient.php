<?php

namespace Notifiable\SmsManager\Clients;

use Notifiable\SmsManager\Contracts\Client as SmsClient;
use Notifiable\SmsManager\Message;
use Notifiable\SmsManager\SentMessage;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioClient implements SmsClient
{
    protected Client $client;

    /**
     * @throws ConfigurationException
     */
    public function __construct(
        protected string $accountSid,
        protected string $authToken,
        protected string $from
    ) {
        $this->client = new Client($accountSid, $authToken);
    }

    /**
     * @throws TwilioException
     */
    #[\Override]
    public function send(Message $message): SentMessage
    {
        $from = $message->from() ?? $this->from;

        $twilioMessage = $this->client->messages->create(
            $message->to(),
            [
                'from' => $from,
                'body' => $message->message(),
            ]
        );

        if ($twilioMessage->sid === null) {
            throw new TwilioException('Message not sent');
        }

        return new SentMessage(
            id: $twilioMessage->sid,
            from: $from,
            to: $message->to(),
            message: $message->message()
        );
    }
}
