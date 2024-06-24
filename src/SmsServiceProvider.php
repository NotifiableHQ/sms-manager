<?php

namespace Notifiable\SmsManager;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    public array $singletons = [
        'sms.manager' => SmsManager::class,
    ];

    /**
     * Register services.
     */
    #[\Override]
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
