<?php

include('../classes/Bootstrap.php');


$ellipsoidNames = '';
while (empty($ellipsoidNames)) {
	echo 'Enter Ellipsoid Name (or "LIST" to list all): ';
	$ellipsoidNames = strtoupper(trim(fgets(STDIN)));

	if ($ellipsoidNames == 'EXIT') {
		die();
	}
	if ($ellipsoidNames == 'LIST') {
		foreach(\Geodetic\ReferenceEllipsoid::getEllipsoidNames() as $key => $ellipsoid) {
   			echo $key , ' => ' , $ellipsoid , PHP_EOL;
		}
		$ellipsoidNames = '';
	}
}
$ellipsoidList = explode(',',$ellipsoidNames);


$ref = new \Geodetic\ReferenceEllipsoid();
foreach($ellipsoidList as $ellipsoid) {
    echo 'Ellipsoid Reference: ' . $ellipsoid . PHP_EOL;
	try {
	    $ref->setEllipsoid($ellipsoid);
        echo 'Ellipsoid Name: ' . $ref->getEllipsoidName() . PHP_EOL;
	    echo '    Semi-Major Axis (Equatorial Radius) .. ' .
	         $ref->getSemiMajorAxis(\Geodetic\Distance::KILOMETRES) .
	         ' ' . \Geodetic\Distance::KILOMETRES . PHP_EOL;
	    echo '    Semi-Minor Axis (Polar Radius) ....... ' .
	         $ref->getSemiMinorAxis(\Geodetic\Distance::KILOMETRES) .
	         ' ' . \Geodetic\Distance::KILOMETRES . PHP_EOL;
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
	         $ref->getMeanRadius(\Geodetic\Distance::KILOMETRES) .
	         ' ' . \Geodetic\Distance::KILOMETRES . PHP_EOL;
	    echo '    Volumetric Radius .................... ' .
	         $ref->getVolumetricRadius(\Geodetic\Distance::KILOMETRES) .
	         ' ' . \Geodetic\Distance::KILOMETRES . PHP_EOL;
	    echo '    Authalic Radius ...................... ' .
	         $ref->getAuthalicRadius(\Geodetic\Distance::KILOMETRES) .
	         ' ' . \Geodetic\Distance::KILOMETRES . PHP_EOL;

	    echo '    Radius of Curvature' . PHP_EOL;
	    echo '        (Meridian) ' . PHP_EOL;
	    for ($l = -90; $l <= 90; $l+=15) {
	        echo str_pad(sprintf('%+02d', $l), 15, ' ', STR_PAD_LEFT) .
	             '° ......................... ' .
	             $ref->getRadiusOfCurvatureMeridian($l, NULL, \Geodetic\Distance::KILOMETRES) .
	             ' ' . \Geodetic\Distance::KILOMETRES . PHP_EOL;
	    }
	    echo '        (Prime Vertical) ' . PHP_EOL;
	    for ($l = -90; $l <= 90; $l+=15) {
	        echo str_pad(sprintf('%+02d', $l), 15, ' ', STR_PAD_LEFT) .
	             '° ......................... ' .
	             $ref->getRadiusOfCurvaturePrimeVertical($l, NULL, \Geodetic\Distance::KILOMETRES) .
	             ' ' . \Geodetic\Distance::KILOMETRES . PHP_EOL;
	    }
	} catch (Exception $e) {
		echo $e->getMessage();
	}

    echo PHP_EOL;
}
