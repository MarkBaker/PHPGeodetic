<?php

include('../classes/Bootstrap.php');


//$latLongArray = array(
//    array(0, -66),
//    array(0, -65),
//    array(-1, -65),
//    array(-1, -66),
//    array(0, -66),
//);
//
//  Expected result: 12308778361.46 to 12308778798.98
//
//$latLongArray = array(
//    array(-68, -66),
//    array(-68, -65),
//    array(-67, -65),
//    array(-67, -66),
//    array(-68, -66),
//);
//
//  Expected result: 4764521310.60 to 4764521767.77
//
//$latLongArray = array(
//    array(9, -53.68),
//    array(9, -52),
//    array(-38, -52),
//    array(-38, -53.68),
//    array(9, -53.68),
//);
//
//  Expected result: 916107764479.79 to 916107767925.56
//
//$latLongArray = array(
//    array(28.6362365, 0.0),
//    array(-21.4366965, 64.2086651),
//    array(4.9898034, 119.491462),
//    array(33.8288302, 100.7759318),
//    array(19.6663563, 77.7414331),
//    array(37.5849405, 65.0724588),
//    array(40.7225762, 33.4000231),
//    array(28.6362365, 0.0),
//);
//
//  Expected result: 47187272237071.78 to 47186908662362.30
//
//$latLongArray = array(
//    array(0, 0),
//    array(0, 11),
//    array(-90, 11),
//    array(-90, 0),
//    array(0, 0),
//);
//
//  Expected result: 7792669220784.69 to 7792666987951.76
//
//$latLongArray = array(
//    array(0, 0),
//    array(0, 0.0001),
//    array(0.0001, 0.0001),
//    array(0.0001, 0),
//    array(0, 0),
//);
//
//  Expected result: 123.09072079083099 to 123.09072080254555
//
//
//$latLongArray = array(
//    array(-3, -48),
//    array(-3, -55),
//    array(1, -55),
//    array(1, -48),
//    array(-3, -48),
//);
//
$latLongArray = array(
    array(-1, 0),   //
    array(-1, 1),   //
    array(-2, 1),   //
    array(-2, 2),   //      _
    array(-1, 2),   //     | |
    array(-1, 3),   //    -   -
    array(0, 3),    //   |     |
    array(0, 2),    //    -   -
    array(1, 2),    //     | |
    array(1, 1),    //      _
    array(0, 1),    //
    array(0, 0),    //
//    array(-1, 0),   //
);
//
//$latLongArray = array(
//    array(-1, 0),   //
//    array(-2, 1),   //
//    array(-2, 2),   //     _
//    array(-1, 3),   //    / \
//    array(0, 3),    //   |   |
//    array(1, 2),    //    \_/
//    array(1, 1),    //
//    array(0, 0),    //
//    array(-1, 0),   //
//);

//$latLongArray = array(
//    array(1, 1),
//    array(1, -1),
//    array(-1, -1),
//    array(-1, 1),
//    array(1, 1),
//);

// Timezone span
//$latLongArray = array(
//    array(1, 179),
//    array(1, -179),
//    array(-1, -179),
//    array(-1, 179),
//    array(1, 179),
//);
//
// Polar span
//$latLongArray = array(
//    array(89, 0),
//    array(89, 60),
//    array(89, 120),
//    array(89, 180),
//    array(89, -120),
//    array(89, -60),
//    array(89, 0),
//);
//


$regionArray = array();
foreach($latLongArray as $latLongValues) {
    $latLong = new \Geodetic\LatLong\CoordinateValues(
        $latLongValues[0],
        $latLongValues[1],
        \Geodetic\Angle::DEGREES,
        0,
        \Geodetic\Distance::METRES
    );
    $regionArray[] = new \Geodetic\LatLong($latLong);
}
$region = new \Geodetic\Region($regionArray);


foreach($regionArray as $perimeterPoint) {
	echo 'Latitude: ' , $perimeterPoint->getLatitude()->getValue() ,
	     ' Longitude: ' , $perimeterPoint->getLongitude()->getValue() , PHP_EOL;
}

echo PHP_EOL;

echo 'Perimeter (using Vincenty): ' , PHP_EOL;

$perimeter1 = $region->getPerimeter();

echo '    Kilometres: ', $perimeter1->getValue(\Geodetic\Distance::KILOMETRES) , PHP_EOL;
echo '    Metres: ', $perimeter1->getValue() , PHP_EOL;
echo '    Miles: ', $perimeter1->getValue(\Geodetic\Distance::MILES) , PHP_EOL;
echo '    Yards: ', $perimeter1->getValue(\Geodetic\Distance::YARDS) , PHP_EOL;
echo '    Nautical Miles: ', $perimeter1->getValue(\Geodetic\Distance::NAUTICAL_MILES) , PHP_EOL , PHP_EOL;

echo 'Perimeter (using Haversine): ' , PHP_EOL;

$perimeter2 = $region->getPerimeter(NULL,TRUE);

echo '    Kilometres: ', $perimeter2->getValue(\Geodetic\Distance::KILOMETRES) , PHP_EOL;
echo '    Metres: ', $perimeter2->getValue() , PHP_EOL;
echo '    Miles: ', $perimeter2->getValue(\Geodetic\Distance::MILES) , PHP_EOL;
echo '    Yards: ', $perimeter2->getValue(\Geodetic\Distance::YARDS) , PHP_EOL;
echo '    Nautical Miles: ', $perimeter2->getValue(\Geodetic\Distance::NAUTICAL_MILES) , PHP_EOL , PHP_EOL;

echo 'Centre Point: ' , PHP_EOL;

$centrePoint1 = $region->getCentrePointPlanar();

echo '    Latitude: ' , $centrePoint1->getLatitude()->getValue() ,
     ' Longitude: ' , $centrePoint1->getLongitude()->getValue() , PHP_EOL , PHP_EOL;

echo 'Planar Area: ' , PHP_EOL;

$area1 = $region->getAreaPlanar();

echo '    Square Kilometres: ', $area1->getValue(\Geodetic\Area::SQUARE_KILOMETRES) , PHP_EOL;
echo '    Square Metres: ', $area1->getValue() , PHP_EOL;
echo '    Hectares: ', $area1->getValue(\Geodetic\Area::HECTARES) , PHP_EOL;
echo '    Square Miles: ', $area1->getValue(\Geodetic\Area::SQUARE_MILES) , PHP_EOL;
echo '    Acres: ', $area1->getValue(\Geodetic\Area::ACRES) , PHP_EOL , PHP_EOL;

echo 'Surface Area: ' , PHP_EOL;

$area2 = $region->getArea();

echo '    Square Kilometres: ', $area2->getValue(\Geodetic\Area::SQUARE_KILOMETRES) , PHP_EOL;
echo '    Square Metres: ', $area2->getValue() , PHP_EOL;
echo '    Hectares: ', $area2->getValue(\Geodetic\Area::HECTARES) , PHP_EOL;
echo '    Square Miles: ', $area2->getValue(\Geodetic\Area::SQUARE_MILES) , PHP_EOL;
echo '    Acres: ', $area2->getValue(\Geodetic\Area::ACRES) , PHP_EOL , PHP_EOL;

$centrePoint = $region->getGeographicCentrePoint();

echo 'Latitude: ' , $centrePoint->getLatitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;
echo 'Longitude: ' , $centrePoint->getLongitude()->getValue() , ' ' ,\Geodetic\Angle::DEGREES , PHP_EOL;

