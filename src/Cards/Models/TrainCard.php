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
        return 'Take train '. $this->trip_number .' from '. $this->from .' to '. $this->to .'. Sit in seat '. $this->seat .'.';
    }
}