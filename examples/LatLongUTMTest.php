<?php

include('../classes/Bootstrap.php');


$lat = 53.408630096933194;
$long = -2.991746664047241;
$height = 0.0;


$latLong = new \Geodetic\LatLong(
    new \Geodetic\LatLong\CoordinateValues(
        $lat,
        $long,
        \Geodetic\Angle::DEGREES,
        $height,
        \Geodetic\Distance::METRES
    )
);

echo PHP_EOL;

echo 'Latitude: ' , $latLong->getLatitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $latLong->getLongitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $latLong->getHeight()->getValue() , ' ' ,\Geodetic\Distance::METRES , PHP_EOL;


echo PHP_EOL , 'Convert to UTM' , PHP_EOL , PHP_EOL;
$datum = new \Geodetic\Datum(\Geodetic\Datum::WGS84);
$utm = $latLong->toUTM($datum);

echo 'Northing: ' , $utm->getNorthing() , PHP_EOL;
echo 'Easting: ' , $utm->getEasting() , PHP_EOL;
echo 'Longitude Zone: ' , $utm->getLongitudeZone() , PHP_EOL;
echo 'Latitude Zone: ' , $utm->getLatitudeZone() , PHP_EOL;


echo PHP_EOL , 'Convert back to Lat/Long' , PHP_EOL , PHP_EOL;
$newLatLong = $utm->toLatLong($datum);

echo 'Latitude: ' , $newLatLong->getLatitude()->getValue() , ' ' , \Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $newLatLong->getLongitude()->getValue() , ' ' , \Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $newLatLong->getHeight()->getValue() , ' ' , \Geodetic\Distance::METRES , PHP_EOL;

echo 'Latitude: ' , $newLatLong->getLatitude()->toDMS(2) , PHP_EOL;
echo 'Longitude: ' , $newLatLong->getLongitude()->toDMS(2) , PHP_EOL;
