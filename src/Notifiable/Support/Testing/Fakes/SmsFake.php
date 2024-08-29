<?php

namespace Notifiable\Support\Testing\Fakes;

class SmsFake
{
    public static function assertEventFired(): bool
    {
        return true;
    }
}
