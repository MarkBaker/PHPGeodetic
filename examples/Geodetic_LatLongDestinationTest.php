<?php

$latLiverpool = 53.408630;
$longLiverpool = -2.991746;
$height = 0.0;

include('../classes/Geodetic_Autoloader.php');


$latLongLiverpool = new Geodetic_LatLong(
    new Geodetic_LatLong_CoordinateValues(
        $latLiverpool,
        $longLiverpool,
        Geodetic_Angle::DEGREES,
        $height,
        Geodetic_Distance::METRES
    )
);

echo 'Starting Point: Liverpool' , PHP_EOL;
echo '    Latitude: ' , $latLongLiverpool->getLatitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongLiverpool->getLongitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongLiverpool->getHeight()->getValue() , ' ' ,Geodetic_Distance::METRES , PHP_EOL;

$bearing = new Geodetic_Angle(135, Geodetic_Angle::DEGREES);
$distance = new Geodetic_Distance(500, Geodetic_Distance::KILOMETRES);

echo 'Initial Bearing: ' , $bearing->toDM(0) , PHP_EOL;
echo 'Distance: ' , $distance->getValue(Geodetic_Distance::KILOMETRES) , ' ' , Geodetic_Distance::KILOMETRES , PHP_EOL;

$destination = $latLongLiverpool->getDestination($bearing, $distance);
echo PHP_EOL;
echo 'FinalDestination: ' , $destination->getLatitude()->toDMS(2), ' ' ,$destination->getLongitude()->toDMS(2) , PHP_EOL;
