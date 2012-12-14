<?php

$latLiverpool = 53.408630;
$longLiverpool = -2.991746;
$latLondon = 51.516481;
$longLondon = -0.128649;
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

$latLongLondon = new Geodetic_LatLong(
    new Geodetic_LatLong_CoordinateValues(
        $latLondon,
        $longLondon,
        Geodetic_Angle::DEGREES,
        $height,
        Geodetic_Distance::METRES
    )
);

echo 'Liverpool' , PHP_EOL;
echo '    Latitude: ' , $latLongLiverpool->getLatitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongLiverpool->getLongitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongLiverpool->getHeight()->getValue() , ' ' ,Geodetic_Distance::METRES , PHP_EOL;
echo PHP_EOL;
echo 'London' , PHP_EOL;
echo '    Latitude: ' , $latLongLondon->getLatitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongLondon->getLongitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongLondon->getHeight()->getValue() , ' ' ,Geodetic_Distance::METRES , PHP_EOL;


$haversineDistance = $latLongLiverpool->getDistanceHaversine($latLongLondon);
$vincentyEllipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_84);
$vincentyDistance = $latLongLiverpool->getDistanceVincenty($latLongLondon, $vincentyEllipsoid);


echo PHP_EOL;
echo 'Distance between Liverpool and London' , PHP_EOL;
echo '    Using Haversine formula: ' , round($haversineDistance->getValue(Geodetic_Distance::KILOMETRES), 4) ,
     ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo '    Using Vincenty formula: ' , round($vincentyDistance->getValue(Geodetic_Distance::KILOMETRES), 4) ,
     ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;

$initialBearing = $latLongLiverpool->getInitialBearing($latLongLondon);
echo 'Initial Bearing: ' , round($initialBearing->getValue(Geodetic_Angle::DEGREES), 3), ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;

$finalBearing = $latLongLiverpool->getFinalBearing($latLongLondon);
echo 'Final Bearing: ' , round($finalBearing->getValue(Geodetic_Angle::DEGREES), 3), ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;

$midpoint = $latLongLiverpool->getMidpoint($latLongLondon);
echo 'Midpoint: ' , $midpoint->getLatitude()->toDMS(2), ' ' ,$midpoint->getLongitude()->toDMS(2) , PHP_EOL;
