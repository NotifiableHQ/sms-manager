<?php

namespace Notifiable\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    public array $singletons = [
        'sms.manager' => SmsManager::class,
    ];
}
