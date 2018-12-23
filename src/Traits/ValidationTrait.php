<?php

namespace TripSorter\Traits;


trait ValidationTrait
{
    /**
     * @param $data array of data
     * @param $rules array of rules
     * @return bool
     */
    public static function validate ($data, $rules): bool
    {
        if (isset($data) && isset($rules)) {

            foreach ($rules as $dataKey=> $methods) {

                foreach ($methods as $method) {
                    $isValid = self::$method($data[$dataKey]);
                    if ($isValid == false)
                        return false;
                }
            }
        }
        return true;
    }

    /**
     * Determine if the given input is not empty
     * @param string $inputValue
     * @return bool
     */
    public static function required($inputValue = null): bool
    {
        if ($inputValue === '' || $inputValue == null) {
            return false;
        }

        return true;
    }

    /**
     * Determine if the given input is string
     * @param string $inputValue
     * @return bool
     */
    public static function isString($inputValue = null): bool
    {
        if (!is_string($inputValue)) {
            return false;
        }

        return true;
    }

}