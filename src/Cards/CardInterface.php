<?php

namespace TripSorter\Cards;


interface CardInterface
{

    /**
     * Determine if the given array is a valid
     * @param array $card
     * @return bool
     */
    public function isValid(array $card): ?bool;

    /**
     * Create a card
     *
     * @param array $card
     * @return CardInterface
     */
    public function create(array $card): ?CardInterface;

    /**
     * Display card as a formatted text
     *
     * @return string
     */
    public function display(): string;
}