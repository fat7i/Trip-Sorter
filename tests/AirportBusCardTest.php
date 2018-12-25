<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TripSorter\Cards\Models\AirportBusCard;
use TripSorter\Cards\CardInterface;
use TripSorter\Exceptions\InvalidCardException;


class AirportBusCardTest extends TestCase
{
    /**
     * @var AirportBusCard
     */
    private $model;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new AirportBusCard();
    }

    /**
     * @return array
     */
    private function getValidCard()
    {
        return [
            'trip_type'   => 'airport_bus',
            'from'        => 'Barcelona',
            'to'          => 'Gerona',
        ];
    }

    /**
     * @return array
     */
    private function getInvalidCard()
    {
        return [
            'trip_type'   => 'airport_bus',
            'from'        => '',
            'to'          => '',
        ];
    }

    /**
     *
     */
    public function testCreateValidCard(): void
    {
        $validCard = $this->getValidCard();


        $card = $this->model->create($validCard);

        $this->assertInstanceOf(
            CardInterface::class,
            $card
        );
    }

    /**
     *
     */
    public function testCreateInvalidCard(): void
    {
        $validCard = $this->getInvalidCard();

        $this->expectException(InvalidCardException::class);

        $this->model->create($validCard);
    }

    /**
     *
     */
    public function testDisplayCard(): void
    {
        $validCard = $this->getValidCard();


        $card = $this->model->create($validCard)->display();


        $this->assertTrue(is_string($card));

        $this->assertEquals('Take the airport bus from Barcelona to Gerona Airport. No seat assignment.',
            trim(preg_replace('/\s\s+/', ' ', $card)));
    }
}