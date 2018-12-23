<?php

namespace TripSorter\Exceptions;


class BrokenChainCardException extends \Exception
{
    protected $message = 'Your Cards have broken a chain';
}