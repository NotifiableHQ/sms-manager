<?php

namespace Notifiable\SmsManager;

use Notifiable\SmsManager\Clients\TwilioClient;
use Notifiable\SmsManager\Clients\VonageClient;
use Notifiable\SmsManager\Contracts\Client;
use Notifiable\SmsManager\Contracts\Factory;
use Illuminate\Support\Manager;
use InvalidArgumentException;
use Twilio\Exceptions\ConfigurationException;

/**
 * @mixin Messenger
 */
class SmsManager extends Manager implements Factory
{
    /** @var Messenger[] */
    protected array $messengers = [];

    #[\Override]
    public function getDefaultDriver(): string
    {
        return (string) $this->config->get('sms.default');
    }

    /**
     * @param  string|null  $driver
     *
     * @throws ConfigurationException
     */
    #[\Override]
    public function driver(
        $driver = null // @pest-ignore-type
    ): Messenger {
        $driver = $driver ?: $this->getDefaultDriver();

        return $this->messengers[$driver] ?? $this->resolve($driver);

    }

    /**
     * @throws ConfigurationException
     */
    #[\Override]
    public function client(?string $name = null): Messenger
    {
        return $this->driver($name);
    }

    /**
     * @throws ConfigurationException
     */
    protected function resolve(string $name): Messenger
    {
        $config = $this->getConfig($name);

        $client = match ($config['provider']) {
            'twilio' => $this->createTwilioClient($config),
            'vonage' => $this->createVonageClient($config),
            default => throw new InvalidArgumentException("{$name} is not supported SMS provider")
        };

        $messenger = (new Messenger($client))->from($config['from']);

        $this->messengers[$name] = $messenger;

        return $messenger;
    }

    /**
     * @return array<string, mixed>
     */
    public function getConfig(string $name): array
    {
        /** @var array<string, mixed> $config */
        $config = $this->config->get("sms.clients.{$name}");

        return $config;
    }

    /**
     * @param  array<string, mixed>  $config
     *
     * @throws ConfigurationException
     */
    public function createTwilioClient(array $config): Client
    {

        return new TwilioClient(
            $config['account_sid'],
            $config['auth_token'],
            $config['from']
        );
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public function createVonageClient(array $config): Client
    {
        return new VonageClient(
            $config['api_key'],
            $config['api_secret'],
            $config['from']
        );
    }
}
