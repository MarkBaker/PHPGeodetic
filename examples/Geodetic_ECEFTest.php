<?php

$x = 3805.0701543279;
$y = -198.86566320382;
$z = 5097.7821917469;

include('../classes/Geodetic_Autoloader.php');


$ecef = new Geodetic_ECEF(
    new Geodetic_ECEF_CoordinateValues(
        $x,
        $y,
        $z,
        Geodetic_Distance::KILOMETRES
    )
);

echo 'X: ' , $ecef->getX()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo 'Y: ' , $ecef->getY()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo 'Z: ' , $ecef->getZ()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;


echo PHP_EOL , 'Convert to Lat/Long' , PHP_EOL , PHP_EOL;
$datum = new Geodetic_Datum(Geodetic_Datum::WGS84);
$latLong = $ecef->toLatLong($datum);

//    http://www.oc.nps.edu/oc2902w/coord/llhxyz.htm

echo 'Latitude: ' , $latLong->getLatitude()->getValue(Geodetic_Angle::DEGREES) , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $latLong->getLongitude()->getValue(Geodetic_Angle::DEGREES) , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $latLong->getHeight()->getValue(Geodetic_Distance::METRES) , ' ' ,Geodetic_Distance::METRES , PHP_EOL;


echo PHP_EOL , 'Convert back to ECEF' , PHP_EOL;
$newECEF = $latLong->toECEF($datum);

echo 'X: ', $newECEF->getX()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo 'Y: ' ,$newECEF->getY()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo 'Z: ' ,$newECEF->getZ()->getValue(Geodetic_Distance::KILOMETRES) , ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;

