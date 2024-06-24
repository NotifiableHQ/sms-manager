<?php

namespace Notifiable\SmsManager\Facades;

use Notifiable\SmsManager\SmsManager;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin SmsManager
 */
class Sms extends Facade
{
    #[\Override]
    protected static function getFacadeAccessor(): string
    {
        return 'sms.manager';
    }
}
