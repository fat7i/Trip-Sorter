<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TripSorter\Cards\Models\TrainCard;
use TripSorter\Cards\CardInterface;
use TripSorter\Exceptions\InvalidCardException;


class TrainCardTest extends TestCase
{
    /**
     * @var TrainCard
     */
    private $model;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new TrainCard();
    }

    /**
     * @return array
     */
    private function getValidCard()
    {
        return [
            'trip_type'   => 'train',
            'from'        => 'Madrid',
            'to'          => 'Barcelona',
            'trip_number' => '78A',
            'seat'        => '45B',
        ];
    }

    /**
     * @return array
     */
    private function getInvalidCard()
    {
        return [
            'trip_type'   => 'train',
            'from'        => '',
            'to'          => '',
            'trip_number' => '78A',
            'seat'        => '45B',
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

        $this->assertEquals('Take train 78A from Madrid to Barcelona. Sit in seat 45B.',
            trim(preg_replace('/\s\s+/', ' ', $card)));
    }
}