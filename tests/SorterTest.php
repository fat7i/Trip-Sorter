<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \TripSorter\Sorter;
use \TripSorter\Exceptions\BrokenChainCardException;


class SorterTest extends TestCase
{
    /**
     * @var Sorter
     */
    private $model;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new Sorter();
    }

    /**
     * Test sort a valid cards
     *
     * @throws BrokenChainCardException
     * @throws \TripSorter\Exceptions\InvalidTypeException
     */
    public function testSortValidCards()
    {
        foreach ($this->getValidCards() as $card) {
            $this->model->addCard($card);
        }
        $this->model->sort();

        $output = $this->model->display();

        $this->assertTrue(is_string($output));

        $this->assertEquals('Take train 78A from Madrid to Barcelona. Sit in seat 45B. Take the airport bus from Barcelona to Gerona Airport. No seat assignment. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344 From Stockholm Airport, take flight SK22 to New York. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg. You have arrived at your final destination',
            trim(preg_replace('/\s\s+/', ' ', $output)));
    }

    /**
     * Test if card have a broken chain
     *
     * @throws BrokenChainCardException
     * @throws \TripSorter\Exceptions\InvalidTypeException
     */
    public function testBrokenChainCards()
    {
        $this->expectException(BrokenChainCardException::class);

        $cards = $this->getValidCards();

        unset($cards[3]);

        foreach ( $cards as $card) {
            $this->model->addCard($card);
        }
        $this->model->sort();
    }

    /**
     * @return array
     */
    private function getValidCards()
    {
        return [
            [
                'trip_type'   => 'flight',
                'from'        => 'Stockholm',
                'to'          => 'New York',
                'trip_number' => 'SK22',
                'seat'        => '7B',
                'gate'        => '22',
                'baggage'     => 'automatic',
            ],
            [
                'trip_type'   => 'train',
                'from'        => 'Madrid',
                'to'          => 'Barcelona',
                'trip_number' => '78A',
                'seat'        => '45B',
            ],
            [
                'trip_type'   => 'airport_bus',
                'from'        => 'Barcelona',
                'to'          => 'Gerona',
            ],
            [
                'trip_type'   => 'flight',
                'from'        => 'Gerona',
                'to'          => 'Stockholm',
                'trip_number' => 'SK455',
                'seat'        => '3A',
                'gate'        => '45B',
                'baggage'     => '344',
            ]
        ];
    }
}