<?php

namespace TripSorter\Cards;

use TripSorter\Exceptions\InvalidCardException;
use TripSorter\Traits\ValidationTrait;


abstract class AbstractCard
{

    /**
     * Validation rules
     *
     * @var array
     */
    public $rules = [
        'from' => ['required', 'isString'],
        'to' => ['required', 'isString'],
    ];

    use ValidationTrait;

    /**
     * Create a card
     *
     * @param array $card
     * @return null|CardInterface
     * @throws InvalidCardException
     */
    public function create(array $card): ?CardInterface
    {
        $isValid = ValidationTrait::validate($card, $this->rules);

        if (!$isValid){
            throw new InvalidCardException();
        }

        foreach ($card as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }


    /**
     * Determine if the given array is a valid
     *
     * @param array $card
     * @return bool|null
     */
    public function isValid(array $card): ?bool
    {
        return ValidationTrait::validate($card, $this->rules);
    }




}