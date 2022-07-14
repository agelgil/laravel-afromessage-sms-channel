<?php

namespace NotificationChannels\AfroMessage\Exceptions;

use Exception;

class CouldNotSendNotification extends Exception
{
    public static function error(string $response): CouldNotSendNotification
    {
        return new static($response);
    }
}
