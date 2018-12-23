<?php

namespace TripSorter\Exceptions;


class InvalidCardException extends \Exception
{
    protected $message = 'The card type provided has a invalid data';
}