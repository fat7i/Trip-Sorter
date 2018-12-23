<?php

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

//phpinfo();

use TripSorter\Sorter;

$sorter = new Sorter();

$sorter->addCard([
    'trip_type'   => 'flight',
    'from'        => 'Stockholm',
    'to'          => 'New York',
    'trip_number' => 'SK22',
    'seat'        => '7B',
    'gate'        => '22',
    'baggage'     => 'automatic',
]);

$sorter->addCard([
    'trip_type'   => 'train',
    'from'        => 'Madrid',
    'to'          => 'Barcelona',
    'trip_number' => '78A',
    'seat'        => '45B',
]);

$sorter->addCard([
    'trip_type'   => 'airport_bus',
    'from'        => 'Barcelona',
    'to'          => 'Gerona',
]);

$sorter->addCard([
    'trip_type'   => 'flight',
    'from'        => 'Gerona',
    'to'          => 'Stockholm',
    'trip_number' => 'SK455',
    'seat'        => '3A',
    'gate'        => '45B',
    'baggage'     => '344',
]);


$sorter->sort();


//-- Display outputs as a formatted text
echo "<pre>";
echo $sorter->display();
echo "</pre>";


//-- Display outputs as array of objects
//echo "<hr />";
//echo "<pre>";
//print_r($sorter->output);
//echo "</pre>";