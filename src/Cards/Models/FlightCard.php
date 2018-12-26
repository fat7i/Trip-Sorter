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
        $str = "From %s Airport, take flight %s to %s. Gate %s, seat %s. \nBaggage ";

        if ( $this->baggage !='automatic')
            $str .= "drop at ticket counter %s";
        else
            $str .= "will we automatically transferred from your last leg.";

        $str = sprintf( $str, $this->from, $this->trip_number, $this->to, $this->gate, $this->seat, $this->baggage);

        return $str;
    }
}