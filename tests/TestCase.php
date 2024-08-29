<?php

namespace Test;

use Illuminate\Config\Repository;
use Notifiable\Sms\SmsServiceProvider;
use Notifiable\Support\Facades\Sms;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app)
    {
        return [
            SmsServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Sms' => Sms::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        tap($app['config'], function (Repository $config) {
            dd($config['sms']);
            $config->set('sms.default', 'twilio');
        });
    }
}
