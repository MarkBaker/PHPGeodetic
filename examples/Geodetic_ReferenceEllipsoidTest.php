<?php

include('../classes/Geodetic_Autoloader.php');


$ref = new Geodetic_ReferenceEllipsoid();
foreach(Geodetic_ReferenceEllipsoid::getEllipsoidNames() as $ellipsoid) {
    echo 'Ellipsoid: ' . $ellipsoid . PHP_EOL;
    $ref->setEllipsoid($ellipsoid);
    echo '    Semi-Major Axis (Equatorial Radius) .. ' .
         $ref->getSemiMajorAxis(Geodetic_Distance::KILOMETRES) .
         ' ' . Geodetic_Distance::KILOMETRES . PHP_EOL;
    echo '    Semi-Minor Axis (Polar Radius) ....... ' .
         $ref->getSemiMinorAxis(Geodetic_Distance::KILOMETRES) .
         ' ' . Geodetic_Distance::KILOMETRES . PHP_EOL;
    echo '    Flattening ........................... ' .
         $ref->getFlattening() .
         PHP_EOL;
    echo '    Inverse Flattening ................... ' .
         $ref->getInverseFlattening() .
         PHP_EOL;
    echo '    First Eccentricity ................... ' .
         $ref->getFirstEccentricity() .
         PHP_EOL;
    echo '    First Eccentricity Squared ........... ' .
         $ref->getFirstEccentricitySquared() .
         PHP_EOL;
    echo '    Second Eccentricity .................. ' .
         $ref->getSecondEccentricity() .
         PHP_EOL;
    echo '    Second Eccentricity Squared .......... ' .
         $ref->getSecondEccentricitySquared() .
         PHP_EOL;

    echo '    Mean Radius .......................... ' .
         $ref->getMeanRadius(Geodetic_Distance::KILOMETRES) .
         ' ' . Geodetic_Distance::KILOMETRES . PHP_EOL;
    echo '    Volumetric Radius .................... ' .
         $ref->getVolumetricRadius(Geodetic_Distance::KILOMETRES) .
         ' ' . Geodetic_Distance::KILOMETRES . PHP_EOL;

    echo '    Radius of Curvature' . PHP_EOL;
    echo '        (Meridian) ' . PHP_EOL;
    for ($l = -90; $l <= 90; $l+=15) {
        echo str_pad(sprintf('%+02d', $l), 15, ' ', STR_PAD_LEFT) .
             '° ......................... ' .
             $ref->getRadiusOfCurvatureMeridian($l, NULL, Geodetic_Distance::KILOMETRES) .
             ' ' . Geodetic_Distance::KILOMETRES . PHP_EOL;
    }
    echo '        (Prime Vertical) ' . PHP_EOL;
    for ($l = -90; $l <= 90; $l+=15) {
        echo str_pad(sprintf('%+02d', $l), 15, ' ', STR_PAD_LEFT) .
             '° ......................... ' .
             $ref->getRadiusOfCurvaturePrimeVertical($l, NULL, Geodetic_Distance::KILOMETRES) .
             ' ' . Geodetic_Distance::KILOMETRES . PHP_EOL;
    }

    echo PHP_EOL;
}
