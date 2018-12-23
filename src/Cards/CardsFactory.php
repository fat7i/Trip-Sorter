<?php

namespace TripSorter\Cards;

use TripSorter\Exceptions\InvalidTypeException;
use TripSorter\Exceptions\ModelNotImplementCardInterfaceException;


class CardsFactory
{

    /**
     * @param string $cardType
     * @return null|CardInterface
     * @throws InvalidTypeException
     */
    public static function make(string $cardType): ?CardInterface
    {
        switch ($cardType) {
            case 'flight';
                return self::createModel('FlightCard');
                break;
            case 'train';
                return self::createModel('TrainCard');
                break;
            case 'airport_bus';
                return self::createModel('AirportBusCard');
                break;
            default:
                throw new InvalidTypeException();
        }
    }

    /**
     * @param string $model
     * @throws ModelNotImplementCardInterfaceException
     * @return null|CardInterface
     */
    private static function createModel(string $model): ?CardInterface
    {
        $interface = 'TripSorter\\Cards\\CardInterface';
        $modelClass = 'TripSorter\\Cards\\Models\\'. $model;

        if (!in_array($interface, class_implements($modelClass))) {
            throw new ModelNotImplementCardInterfaceException(sprintf('%s must implement %s', $modelClass, $interface));
        }

        return new $modelClass;
    }
}