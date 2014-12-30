<?php

$lat = 53.408630096933194;
$long = -2.991746664047241;
$height = 0.0;

include('../Geodetic.phar');


$latLong = new \Geodetic\LatLong(
    new \Geodetic\LatLong\CoordinateValues(
        $lat,
        $long,
        \Geodetic\Angle::DEGREES,
        $height,
        \Geodetic\Distance::METRES
    )
);

echo 'OSGB36 Coordinates' , PHP_EOL;

echo 'Latitude: ' , $latLong->getLatitude()->getValue() , ' ' , \Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $latLong->getLongitude()->getValue() , ' ' , \Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $latLong->getHeight()->getValue() , ' ' , \Geodetic\Distance::METRES , PHP_EOL;

echo PHP_EOL , 'Convert to ECEF' , PHP_EOL , PHP_EOL;
$fromDatum = new \Geodetic\Datum(\Geodetic\Datum::OSGB36);
$ecef = $latLong->toECEF($fromDatum);

//    http://www.oc.nps.edu/oc2902w/coord/llhxyz.htm

echo 'X: ' , $ecef->getX()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' , \Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Y: ' , $ecef->getY()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' , \Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Z: ' , $ecef->getZ()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' , \Geodetic\Distance::KILOMETRES , PHP_EOL;

echo PHP_EOL , 'Convert from OSGB36 to WGS84' , PHP_EOL , PHP_EOL;
$ecef->toWGS84($fromDatum);

echo 'X: ' , $ecef->getX()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' , \Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Y: ' , $ecef->getY()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' , \Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Z: ' , $ecef->getZ()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' , \Geodetic\Distance::KILOMETRES , PHP_EOL;


$toDatum = new \Geodetic\Datum(\Geodetic\Datum::WGS84);
echo PHP_EOL , 'Convert back to Lat/Long for WGS84' , PHP_EOL , PHP_EOL;
$newLatLong = $ecef->toLatLong($toDatum);

echo 'Latitude: ' , $newLatLong->getLatitude()->getValue() , ' ' , \Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $newLatLong->getLongitude()->getValue() , ' ' , \Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $newLatLong->getHeight()->getValue() , ' ' , \Geodetic\Distance::METRES , PHP_EOL;

echo 'Latitude: ' , $newLatLong->getLatitude()->toDMS() , PHP_EOL;
echo 'Longitude: ' , $newLatLong->getLongitude()->toDMS() , PHP_EOL;
