<?php

namespace Notifiable\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Notifiable\Support\Testing\Fakes\SmsFake;

/**
 * @method static string getDefaultDriver()
 * @method static \Notifiable\Sms\Messenger driver(string|null $driver = null)
 * @method static \Notifiable\Sms\Messenger client(string|null $name = null)
 * @method static array getConfig(string $name)
 * @method static \Notifiable\Contracts\Client createTwilioClient(array $config)
 * @method static \Notifiable\Contracts\Client createVonageClient(array $config)
 * @method static \Notifiable\Sms\SmsManager extend(string $driver, \Closure $callback)
 * @method static array getDrivers()
 * @method static \Illuminate\Contracts\Container\Container getContainer()
 * @method static \Notifiable\Sms\SmsManager setContainer(\Illuminate\Contracts\Container\Container $container)
 * @method static \Notifiable\Sms\SmsManager forgetDrivers()
 * @method static \Notifiable\Sms\Messenger from(string|null $from)
 * @method static \Notifiable\Sms\Messenger to(string $to)
 * @method static \Notifiable\Sms\Messenger message(string $message)
 * @method static \Notifiable\Sms\SentMessage send()
 *
 * @see \Notifiable\Sms\SmsManager
 */
class Sms extends Facade
{
    #[\Override]
    protected static function getFacadeAccessor(): string
    {
        return 'sms.manager';
    }

    public static function fake(): void
    {
        static::swap(new SmsFake());
    }
}
