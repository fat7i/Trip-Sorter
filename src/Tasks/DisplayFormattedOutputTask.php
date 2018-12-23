<?php

namespace TripSorter\Tasks;


class DisplayFormattedOutputTask implements TaskInterface
{
    /**
     * @var array
     */
    private $output;

    /**
     * @return string
     */
    public function run(): string
    {
        $str = '';

        foreach ($this->output as $card) {
            $str .= (string) $card->display() . "\n\n";
        }

        $str .= "You have arrived at your final destination";

        return $str;
    }

    /**
     * @param array $output
     * @return DisplayFormattedOutputTask
     */
    public function setOutput(array $output): DisplayFormattedOutputTask
    {
        $this->output = $output;
        return $this;
    }


}