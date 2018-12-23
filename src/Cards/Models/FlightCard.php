<?php

namespace TripSorter\Cards\Models;

use TripSorter\Cards\AbstractCard;
use TripSorter\Cards\CardInterface;


class FlightCard extends AbstractCard implements CardInterface
{
    /**
     * @var string
     */
    public $type = 'flight';


    /**
     * @var array
     */
    public $rules = [
        'from' => ['required', 'isString'],
        'to' => ['required', 'isString'],
        'trip_number' => ['required'],
        'seat' => ['required'],
        'gate' => ['required'],
        'baggage' => ['required'],
    ];

    /**
     * @inheritdoc
     * @return string
     */
    public function display(): string
    {
        $str = 'From '. $this->from .' Airport, take flight '. $this->trip_number .' to '. $this->to. '. Gate '. $this->gate .', seat '. $this->seat . ". \n";

        if ( $this->baggage !='automatic')
            $str .= 'Baggage drop at ticket	counter	344';
        else
            $str .= 'Baggage will we automatically transferred from your last leg.';

        return $str;
    }
}