<?php

namespace Notifiable\Sms;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\MultipleInstanceManager;
use Notifiable\Contracts\Factory;
use Notifiable\Sms\Clients\TwilioClient;
use Notifiable\Sms\Clients\VonageClient;
use Twilio\Exceptions\ConfigurationException;

/**
 * @mixin \Notifiable\Sms\Messenger
 */
class SmsManager extends MultipleInstanceManager implements Factory
{
    protected $driverKey = 'client';

    public function getDefaultInstance(): string
    {
        /** @var string $default */
        $default = $this->config->get('sms.default');

        return $default;
    }

    public function setDefaultInstance($name): void
    {
        $this->config->set('sms.default', $name);
    }

    /**
     * @return array<string, mixed>
     */
    public function getInstanceConfig($name): array
    {
        /** @var array<string, mixed> $config */
        $config = $this->config->get("sms.messengers.{$name}");

        return $config;
    }

    #[\Override]
    public function messenger(?string $name = null): Messenger
    {
        /** @var Messenger $instance */
        $instance = $this->instance($name);

        return $instance;
    }

    /**
     * @param  array<string, string>  $config
     *
     * @throws ConfigurationException
     */
    public function createTwilioClient(array $config): Messenger
    {
        $client = new TwilioClient(
            $config['account_sid'],
            $config['auth_token'],
            $config['from']
        );

        /** @var Dispatcher|null $dispatcher */
        $dispatcher = $this->app->get('events');

        return new Messenger($client, $dispatcher);
    }

    /**
     * @param  array<string, string>  $config
     */
    public function createVonageClient(array $config): Messenger
    {
        $client = new VonageClient(
            $config['key'],
            $config['secret'],
            $config['from']
        );

        /** @var Dispatcher|null $dispatcher */
        $dispatcher = $this->app->get('events');

        return new Messenger($client, $dispatcher);
    }
}
