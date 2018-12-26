<?php

namespace TripSorter\Cards\Models;

use TripSorter\Cards\AbstractCard;
use TripSorter\Cards\CardInterface;


class AirportBusCard extends AbstractCard implements CardInterface
{
    /**
     * @var string
     */
    public $type = 'airport_bus';

    /**
     * @var array
     */
    public $rules = [
        'from' => ['required', 'isString'],
        'to' => ['required', 'isString'],
    ];

    /**
     * @inheritdoc
     * @return string
     */
    public function display(): string
    {
        $str = "Take the airport bus from %s to %s Airport. No seat assignment.";

        return sprintf( $str, $this->from, $this->to);
    }
}