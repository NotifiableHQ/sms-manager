<?php

namespace Notifiable\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
        /** @var array<string, string> */
        public array $singletons = [
            'sms.manager' => SmsManager::class,
        ];

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../../config/sms.php' => config_path('sms.php'),
        ]);

        $this->app->singleton(SmsManager::class, function ($app) {
            return new SmsManager($app);
        });
    }
}
