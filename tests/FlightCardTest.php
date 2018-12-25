<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TripSorter\Cards\Models\FlightCard;
use TripSorter\Cards\CardInterface;
use TripSorter\Exceptions\InvalidCardException;


class FlightCardTest extends TestCase
{
    /**
     * @var FlightCard
     */
    private $model;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new FlightCard();
    }

    /**
     * @return array
     */
    private function getValidCard()
    {
        return [
            'trip_type'   => 'flight',
            'from'        => 'Stockholm',
            'to'          => 'New York',
            'trip_number' => 'SK22',
            'seat'        => '7B',
            'gate'        => '22',
            'baggage'     => 'automatic',
        ];
    }

    /**
     * @return array
     */
    private function getInvalidCard()
    {
        return [
            'trip_type'   => 'flight',
            'from'        => '',
            'to'          => '',
            'trip_number' => 'SK22',
            'seat'        => '7B',
            'gate'        => '22',
            'baggage'     => 'automatic',
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

        $this->assertEquals('From Stockholm Airport, take flight SK22 to New York. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.',
            trim(preg_replace('/\s\s+/', ' ', $card)));
    }
}