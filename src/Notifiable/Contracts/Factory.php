<?php

namespace Notifiable\Contracts;

use Notifiable\Sms\Messenger;

interface Factory
{
    public function client(string $name): Messenger;
}
