<?php

include('../classes/Bootstrap.php');


$latTokyo = 35.681841;
$longTokyo = 139.758797;
$latSeattle = 47.601533;
$longSeattle = -122.328644;
$height = 0.0;


$latLongTokyo = new \Geodetic\LatLong(
    new \Geodetic\LatLong\CoordinateValues(
        $latTokyo,
        $longTokyo,
        \Geodetic\Angle::DEGREES,
        $height,
        \Geodetic\Distance::METRES
    )
);

$latLongSeattle = new \Geodetic\LatLong(
    new \Geodetic\LatLong\CoordinateValues(
        $latSeattle,
        $longSeattle,
        \Geodetic\Angle::DEGREES,
        $height,
        \Geodetic\Distance::METRES
    )
);

echo 'Tokyo' , PHP_EOL;
echo '    Latitude: ' , $latLongTokyo->getLatitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongTokyo->getLongitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongTokyo->getHeight()->getValue() , ' ' ,\Geodetic\Distance::METRES , PHP_EOL;
echo PHP_EOL;
echo 'Seattle' , PHP_EOL;
echo '    Latitude: ' , $latLongSeattle->getLatitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongSeattle->getLongitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongSeattle->getHeight()->getValue() , ' ' ,\Geodetic\Distance::METRES , PHP_EOL;


$haversineDistance = $latLongTokyo->getDistanceHaversine($latLongSeattle);
$vincentyEllipsoid = new \Geodetic\ReferenceEllipsoid(\Geodetic\ReferenceEllipsoid::WGS_84);
$vincentyDistance = $latLongTokyo->getDistanceVincenty($latLongSeattle, $vincentyEllipsoid);


echo PHP_EOL;
echo 'Distance between Tokyo and Seattle' , PHP_EOL;
echo '    Using Haversine formula: ' , round($haversineDistance->getValue(\Geodetic\Distance::KILOMETRES), 4) ,
     ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;
echo '    Using Vincenty formula: ' , round($vincentyDistance->getValue(\Geodetic\Distance::KILOMETRES), 4) ,
     ' ' ,\Geodetic\Distance::KILOMETRES , PHP_EOL;

$initialBearing = $latLongTokyo->getInitialBearing($latLongSeattle);
echo 'Initial Bearing: ' , round($initialBearing->getValue(\Geodetic\Angle::DEGREES), 3), ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;

$finalBearing = $latLongTokyo->getFinalBearing($latLongSeattle);
echo 'Final Bearing: ' , round($finalBearing->getValue(\Geodetic\Angle::DEGREES), 3), ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;

$midpoint = $latLongTokyo->getMidpoint($latLongSeattle);
echo 'Midpoint: ' , $midpoint->getLatitude()->toDMS(2), ' ' ,$midpoint->getLongitude()->toDMS(2) , PHP_EOL;
