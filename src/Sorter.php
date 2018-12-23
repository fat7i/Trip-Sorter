<?php

namespace TripSorter;

use TripSorter\Exceptions\BrokenChainCardException;
use TripSorter\Exceptions\InvalidTypeException;
use TripSorter\Tasks\AddCardTask;
use TripSorter\Tasks\DisplayFormattedOutputTask;


class Sorter
{
    /**
     * The cards container
     * @var
     */
    public $cards;

    /**
     * @var array
     */
    public $output;

    /**
     * @var array
     */
    private $froms;

    /**
     * @var array
     */
    private $tos;

    /**
     * @var AddCardTask
     */
    private $addCardTask;

    /**
     * @var DisplayFormattedOutputTask
     */
    private $displayFormattedOutputTask;


    /**
     * Sorter constructor.
     */
    public function __construct()
    {
        $this->addCardTask = new AddCardTask();
        $this->displayFormattedOutputTask = new DisplayFormattedOutputTask();
    }


    /**
     * @param array $card
     * @throws InvalidTypeException
     * @return Sorter
     */
    public function addCard(array $card): Sorter
    {

        $cardObject = $this->addCardTask
            ->setType($card['trip_type'])
            ->create($card)
            ->run();

        $this->cards[] = $cardObject;

        return $this;
    }

    /**
     * @return Sorter
     * @throws BrokenChainCardException
     */
    public function sort(): Sorter
    {

        $this->setFroms();
        $this->setTos();

        $start = $this->getStart();

        $to = $this->cards[$start]->to;

        $this->addToOutput($start);

        $cardsCount = count($this->cards);

        for ($i=0; $i<$cardsCount; $i++) {

            $next = $this->next($to);

            $to = $this->cards[$next]->to;

            $this->addToOutput($next);

        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFroms()
    {
        return $this->froms;
    }

    /**
     *
     */
    public function setFroms()
    {
        $this->froms = array_column($this->cards, 'from');
    }

    /**
     * @return array
     */
    public function getTos()
    {
        return $this->tos;
    }

    /**
     *
     */
    public function setTos()
    {
        $this->tos = array_column($this->cards, 'to');
    }

    /**
     * Get a start  destination
     * @return mixed
     */
    public function getStart()
    {
        $starts = $this->getFroms();
        $ends = $this->getTos();

        return array_keys(array_diff($starts, $ends))[0];
    }


    /**
     * Get next card by given $to
     *
     * @param string $to
     * @return int|string
     * @throws BrokenChainCardException
     */
    public function next(string $to)
    {
        foreach ($this->cards as $key => $card) {
            if ($card->from === $to) {
                return $key;
            }
        }

        throw new BrokenChainCardException();
    }

    /**
     * Add Card to output by given key,
     * Then unset it from cards container
     *
     * @param int $key
     */
    public function addToOutput(int $key)
    {
        $this->output[] = $this->cards[$key];
        unset($this->cards[$key]);
    }

    /**
     * Display output as a formatted text
     *
     * @return string
     */
    public function display()
    {
        return $this->displayFormattedOutputTask
                    ->setOutput($this->output)
                    ->run();
    }


}