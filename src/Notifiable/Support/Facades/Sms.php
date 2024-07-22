<?php

namespace Notifiable\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Notifiable\Support\Testing\Fakes\SmsFake;

/**
 * @method static string getDefaultInstance()
 * @method static void setDefaultInstance(string $name)
 * @method static array getInstanceConfig(string $name)
 * @method static \Notifiable\Sms\Messenger client(string|null $name = null)
 * @method static \Notifiable\Sms\Messenger createTwilioClient(array $config)
 * @method static \Notifiable\Sms\Messenger createVonageClient(array $config)
 * @method static mixed instance(string|null $name = null)
 * @method static \Notifiable\Sms\SmsManager forgetInstance(array|string|null $name = null)
 * @method static void purge(string|null $name = null)
 * @method static \Notifiable\Sms\SmsManager extend(string $name, \Closure $callback)
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
