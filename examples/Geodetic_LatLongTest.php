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

echo PHP_EOL , 'Convert to ECEF' , PHP_EOL , PHP_EOL;
$datum = new Geodetic_Datum(Geodetic_Datum::WGS84);
$ecef = $latLong->toECEF($datum);

//    http://www.oc.nps.edu/oc2902w/coord/llhxyz.htm

echo 'X: ' , $ecef->getX()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo 'Y: ' , $ecef->getY()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo 'Z: ' , $ecef->getZ()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;


echo PHP_EOL , 'Convert back to Lat/Long' , PHP_EOL , PHP_EOL;
$newLatLong = $ecef->toLatLong($datum);

echo 'Latitude: ' , $newLatLong->getLatitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $newLatLong->getLongitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $newLatLong->getHeight()->getValue() , ' ' ,Geodetic_Distance::METRES , PHP_EOL;


