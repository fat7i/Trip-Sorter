<?php

namespace TripSorter\Exceptions;


class ModelNotImplementCardInterfaceException extends \LogicException
{
    protected $message = 'Model must implement CardInterface';
}