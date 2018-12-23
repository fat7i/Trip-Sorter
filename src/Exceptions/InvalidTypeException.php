<?php

namespace TripSorter\Exceptions;


class InvalidTypeException extends \Exception
{
    protected $message = 'The card type provided has no corresponding object';
}