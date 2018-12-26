<?php

namespace TripSorter\Cards\Models;

use TripSorter\Cards\AbstractCard;
use TripSorter\Cards\CardInterface;


class TrainCard extends AbstractCard implements CardInterface
{
    /**
     * @var string
     */
    public $type = 'train';

    /**
     * @var array
     */
    public $rules = [
        'from' => ['required', 'isString'],
        'to' => ['required', 'isString'],
        'trip_number' => ['required'],
        'seat' => ['required'],
    ];

    /**
     * @inheritdoc
     * @return string
     */
    public function display(): string
    {
        $str = "Take train %s from %s to %s. Sit in seat %s.";

        return sprintf( $str, $this->trip_number, $this->from, $this->to, $this->seat);
    }
}