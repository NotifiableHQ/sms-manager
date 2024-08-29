<?php

namespace Notifiable\Contracts;

use Notifiable\Sms\Messenger;

interface Factory
{
    public function messenger(string $name): Messenger;
}
