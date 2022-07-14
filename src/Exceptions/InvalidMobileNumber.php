<?php

namespace NotificationChannels\AfroMessage\Exceptions;

class InvalidMobileNumber extends \Exception
{
    public static function error(): InvalidMobileNumber
    {
        return new static('The destination `mobile number` is invalid');
    }
}
