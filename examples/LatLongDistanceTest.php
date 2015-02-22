<?php

include('../classes/Bootstrap.php');


$latLiverpool = 53.408630;
$longLiverpool = -2.991746;
$latLondon = 51.516481;
$longLondon = -0.128649;
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

$latLongLondon = new \Geodetic\LatLong(
    new \Geodetic\LatLong\CoordinateValues(
        $latLondon,
        $longLondon,
        \Geodetic\Angle::DEGREES,
        $height,
        \Geodetic\Distance::METRES
    )
);

echo 'Liverpool' , PHP_EOL;
echo '    Latitude: ' , $latLongLiverpool->getLatitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongLiverpool->getLongitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongLiverpool->getHeight()->getValue() , ' ' ,\Geodetic\Distance::METRES , PHP_EOL;
echo PHP_EOL;
echo 'London' , PHP_EOL;
echo '    Latitude: ' , $latLongLondon->getLatitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongLondon->getLongitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongLondon->getHeight()->getValue() , ' ' ,\Geodetic\Distance::METRES , PHP_EOL;


$haversineDistance = $latLongLiverpool->getDistanceHaversine($latLongLondon);
$vincentyEllipsoid = new \Geodetic\ReferenceEllipsoid(\Geodetic\ReferenceEllipsoid::WGS_84);
$vincentyDistance = $latLongLiverpool->getDistanceVincenty($latLongLondon, $vincentyEllipsoid);


echo PHP_EOL;
echo 'Distance between Liverpool and London' , PHP_EOL;
echo '    Using Haversine formula: ' , round($haversineDistance->getValue(\Geodetic\Distance::KILOMETRES), 4) ,
     ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;
echo '    Using Vincenty formula: ' , round($vincentyDistance->getValue(\Geodetic\Distance::KILOMETRES), 4) ,
     ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;

$initialBearing = $latLongLiverpool->getInitialBearing($latLongLondon);
echo 'Initial Bearing: ' , round($initialBearing->getValue(\Geodetic\Angle::DEGREES), 3), ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;

$finalBearing = $latLongLiverpool->getFinalBearing($latLongLondon);
echo 'Final Bearing: ' , round($finalBearing->getValue(\Geodetic\Angle::DEGREES), 3), ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;

$midpoint = $latLongLiverpool->getMidpoint($latLongLondon);
echo 'Midpoint: ' , $midpoint->getLatitude()->toDMS(3), ' ' ,$midpoint->getLongitude()->toDMS(3) , PHP_EOL;
