<?php

namespace Test;

use Illuminate\Support\Facades\Config;
use Notifiable\Sms\Clients\TwilioClient;
use Notifiable\Sms\SmsManager;

class ExampleTest extends TestCase
{
    public function testMangerReturnsTwilioClient()
    {
        // config
        $clients = Config::get('sms.messengers');

        $clients['twilio-test'] = [
            'client' => 'twilio',
            'account_sid' => 'test',
            'auth_token' => 'test',
            'from' => '123',
        ];

        Config::set('sms.clients', $clients);

        $messenger = app(SmsManager::class)->client('twilio-test');

        $this->assertInstanceOf(TwilioClient::class, $messenger->client);

    }

    public function testMangerReturnsVonageClient() {}
}
