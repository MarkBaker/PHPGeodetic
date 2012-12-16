<?php

$lat = 53.408630096933194;
$long = -2.991746664047241;
$height = 0.0;

include('../classes/Geodetic_Autoloader.php');


$latLong = new Geodetic_LatLong(
    new Geodetic_LatLong_CoordinateValues(
        $lat,
        $long,
        Geodetic_Angle::DEGREES,
        $height,
        Geodetic_Distance::METRES
    )
);

echo PHP_EOL;

echo 'Latitude: ' , $latLong->getLatitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $latLong->getLongitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $latLong->getHeight()->getValue() , ' ' ,Geodetic_Distance::METRES , PHP_EOL;


echo PHP_EOL , 'Convert to UTM' , PHP_EOL , PHP_EOL;
$datum = new Geodetic_Datum(Geodetic_Datum::WGS84);
$utm = $latLong->toUTM($datum);

echo 'Northing: ' , $utm->getNorthing() , PHP_EOL;
echo 'Easting: ' , $utm->getEasting() , PHP_EOL;
echo 'Longitude Zone: ' , $utm->getLongitudeZone() , PHP_EOL;
echo 'Latitude Zone: ' , $utm->getLatitudeZone() , PHP_EOL;


echo PHP_EOL , 'Convert back to Lat/Long' , PHP_EOL , PHP_EOL;
$newLatLong = $utm->toLatLong($datum);

echo 'Latitude: ' , $newLatLong->getLatitude()->getValue() , ' ' , Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $newLatLong->getLongitude()->getValue() , ' ' , Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $newLatLong->getHeight()->getValue() , ' ' , Geodetic_Distance::METRES , PHP_EOL;

echo 'Latitude: ' , $newLatLong->getLatitude()->toDMS(2) , PHP_EOL;
echo 'Longitude: ' , $newLatLong->getLongitude()->toDMS(2) , PHP_EOL;
