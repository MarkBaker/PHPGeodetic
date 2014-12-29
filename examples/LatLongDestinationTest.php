<?php

include('../classes/Bootstrap.php');


$latLiverpool = 53.408630;
$longLiverpool = -2.991746;
$height = 0.0;


$latLongLiverpool = new \Geodetic\LatLong(
    new \Geodetic\LatLong\CoordinateValues(
        $latLiverpool,
        $longLiverpool,
        \Geodetic\Angle::DEGREES,
        $height,
        \Geodetic\Distance::METRES
    )
);

echo 'Starting Point: Liverpool' , PHP_EOL;
echo '    Latitude: ' , $latLongLiverpool->getLatitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongLiverpool->getLongitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongLiverpool->getHeight()->getValue() , ' ' ,\Geodetic\Distance::METRES , PHP_EOL;

$bearing = new \Geodetic\Angle(135, \Geodetic\Angle::DEGREES);
$distance = new \Geodetic\Distance(500, \Geodetic\Distance::KILOMETRES);

echo 'Initial Bearing: ' , $bearing->toDM(0) , PHP_EOL;
echo 'Distance: ' , $distance->getValue(\Geodetic\Distance::KILOMETRES) , ' ' , \Geodetic\Distance::KILOMETRES , PHP_EOL;

$destination = $latLongLiverpool->getDestination($bearing, $distance);
echo PHP_EOL;
echo 'FinalDestination: ' , $destination->getLatitude()->toDMS(2), ' ' ,$destination->getLongitude()->toDMS(2) , PHP_EOL;
