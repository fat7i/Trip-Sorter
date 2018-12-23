<?php

namespace TripSorter\Tasks;

use TripSorter\Cards\CardInterface;
use TripSorter\Cards\CardsFactory;


class AddCardTask implements TaskInterface
{
    /**
     * @var
     */
    public $model;

    /**
     * @return mixed
     */
    public function run(): CardInterface
    {
        return $this->model;
    }

    /**
     * @param string $type
     * @return AddCardTask
     * @throws \TripSorter\Exceptions\InvalidTypeException
     */
    public function setType(string $type): AddCardTask
    {
        $this->model = CardsFactory::make($type);
        return $this;
    }

    /**
     * @param array $card
     * @return AddCardTask
     */
    public function create(array $card): AddCardTask
    {
        $this->model->create($card);
        return $this;
    }


}