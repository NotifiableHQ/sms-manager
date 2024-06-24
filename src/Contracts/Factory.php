<?php

namespace Notifiable\SmsManager\Contracts;

use Notifiable\SmsManager\Messenger;

interface Factory
{
    public function client(string $name): Messenger;
}
