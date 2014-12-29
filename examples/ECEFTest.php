<?php

include('../classes/Bootstrap.php');


$x = 3805.0701543279;
$y = -198.86566320382;
$z = 5097.7821917469;


$ecef = new \Geodetic\ECEF(
    new \Geodetic\ECEF\CoordinateValues(
        $x,
        $y,
        $z,
        \Geodetic\Distance::KILOMETRES
    )
);

echo 'X: ' , $ecef->getX()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Y: ' , $ecef->getY()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Z: ' , $ecef->getZ()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;


echo PHP_EOL , 'Convert to Lat/Long' , PHP_EOL , PHP_EOL;
$datum = new \Geodetic\Datum(\Geodetic\Datum::WGS84);
$latLong = $ecef->toLatLong($datum);

//    http://www.oc.nps.edu/oc2902w/coord/llhxyz.htm

echo 'Latitude: ' , $latLong->getLatitude()->getValue(\Geodetic\Angle::DEGREES) , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $latLong->getLongitude()->getValue(\Geodetic\Angle::DEGREES) , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Height: ' , $latLong->getHeight()->getValue(\Geodetic\Distance::METRES) , ' ' ,\Geodetic\Distance::METRES , PHP_EOL;


echo PHP_EOL , 'Convert back to ECEF' , PHP_EOL;
$newECEF = $latLong->toECEF($datum);

echo 'X: ', $newECEF->getX()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Y: ' ,$newECEF->getY()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;
echo 'Z: ' ,$newECEF->getZ()->getValue(\Geodetic\Distance::KILOMETRES) , ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;

