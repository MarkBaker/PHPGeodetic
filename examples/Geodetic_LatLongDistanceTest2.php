<?php

$latTokyo = 35.681841;
$longTokyo = 139.758797;
$latSeattle = 47.601533;
$longSeattle = -122.328644;
$height = 0.0;

include('../classes/Geodetic_Autoloader.php');


$latLongTokyo = new Geodetic_LatLong(
    new Geodetic_LatLong_CoordinateValues(
        $latTokyo,
        $longTokyo,
        Geodetic_Angle::DEGREES,
        $height,
        Geodetic_Distance::METRES
    )
);

$latLongSeattle = new Geodetic_LatLong(
    new Geodetic_LatLong_CoordinateValues(
        $latSeattle,
        $longSeattle,
        Geodetic_Angle::DEGREES,
        $height,
        Geodetic_Distance::METRES
    )
);

echo 'Tokyo' , PHP_EOL;
echo '    Latitude: ' , $latLongTokyo->getLatitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongTokyo->getLongitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongTokyo->getHeight()->getValue() , ' ' ,Geodetic_Distance::METRES , PHP_EOL;
echo PHP_EOL;
echo 'Seattle' , PHP_EOL;
echo '    Latitude: ' , $latLongSeattle->getLatitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Longitude: ' , $latLongSeattle->getLongitude()->getValue() , ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
echo '    Height: ' , $latLongSeattle->getHeight()->getValue() , ' ' ,Geodetic_Distance::METRES , PHP_EOL;


$haversineDistance = $latLongTokyo->getDistanceHaversine($latLongSeattle);
$vincentyEllipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_84);
$vincentyDistance = $latLongTokyo->getDistanceVincenty($latLongSeattle, $vincentyEllipsoid);


echo PHP_EOL;
echo 'Distance between Tokyo and Seattle' , PHP_EOL;
echo '    Using Haversine formula: ' , round($haversineDistance->getValue(Geodetic_Distance::KILOMETRES), 4) ,
     ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;
echo '    Using Vincenty formula: ' , round($vincentyDistance->getValue(Geodetic_Distance::KILOMETRES), 4) ,
     ' ' ,Geodetic_Distance::KILOMETRES , PHP_EOL;

$initialBearing = $latLongTokyo->getInitialBearing($latLongSeattle);
echo 'Initial Bearing: ' , round($initialBearing->getValue(Geodetic_Angle::DEGREES), 3), ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;

$finalBearing = $latLongTokyo->getFinalBearing($latLongSeattle);
echo 'Final Bearing: ' , round($finalBearing->getValue(Geodetic_Angle::DEGREES), 3), ' ' ,Geodetic_Angle::DEGREES , PHP_EOL;
