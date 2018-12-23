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
        return 'Take the airport bus from '. $this->from .' to '. $this->to .' Airport. No seat assignment.';
    }
}