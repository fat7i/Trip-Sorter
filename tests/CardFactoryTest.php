<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TripSorter\Cards\CardInterface;
use TripSorter\Cards\CardsFactory;
use TripSorter\Exceptions\InvalidTypeException;


class CardFactoryTest extends TestCase
{

    /**
     * Create a Model for flight card
     *
     * @throws InvalidTypeException
     */
    public function testCreateFlightCardType(): void
    {
        $this->assertInstanceOf(
            CardInterface::class,
            CardsFactory::make('flight')
        );
    }

    /**
     * Create a Model for train card
     *
     * @throws InvalidTypeException
     */
    public function testCreateTrainCardType(): void
    {
        $this->assertInstanceOf(
            CardInterface::class,
            CardsFactory::make('train')
        );
    }

    /**
     * Create a Model for airport bus card
     *
     * @throws InvalidTypeException
     */
    public function testCreateAirportBusCardType(): void
    {
        $this->assertInstanceOf(
            CardInterface::class,
            CardsFactory::make('airport_bus')
        );
    }

    /**
     * Create a Model for none valid card type
     * 
     * @throws InvalidTypeException
     */
    public function testCreateNoneValidCardType(): void
    {
        $this->expectException(InvalidTypeException::class);
        CardsFactory::make('none_valid');
    }


}