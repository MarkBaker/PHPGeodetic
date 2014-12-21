<?php

include('../classes/Bootstrap.php');


$datumNames = '';
while (empty($datumNames)) {
	echo 'Enter Datum Name (or "LIST" to list all): ';
	$datumNames = strtoupper(trim(fgets(STDIN)));

	if (empty($datumNames) || $datumNames == 'EXIT') {
		die();
	}
	if ($datumNames == 'LIST') {
		foreach(\Geodetic\Datum::getDatumNames() as $key => $datum) {
   			echo $key , ' => ' , $datum , PHP_EOL;
		}
		$datumNames = '';
	}
}
$datumList = explode(',',$datumNames);


$ref = new \Geodetic\Datum();
foreach($datumList as $datum) {
    echo 'Datum: ' , $datum , PHP_EOL;
	try {
	    $ref->setDatum($datum);
	    echo '    Reference Ellipsoid ...................... ' ,
	         $ref->getReferenceEllipsoidName() , PHP_EOL;
	    echo '        Semi-Major Axis (Equatorial Radius) .. ' ,
	         $ref->getReferenceEllipsoid()->getSemiMajorAxis(\Geodetic\Distance::KILOMETRES) ,
	         ' ' , \Geodetic\Distance::KILOMETRES ,
	         PHP_EOL;
	    echo '        Semi-Minor Axis (Polar Radius) ....... ' ,
	         $ref->getReferenceEllipsoid()->getSemiMinorAxis(\Geodetic\Distance::KILOMETRES) ,
	         ' ' , \Geodetic\Distance::KILOMETRES ,
	         PHP_EOL;
	    echo '        Flattening ........................... ' ,
	         $ref->getReferenceEllipsoid()->getFlattening() , PHP_EOL;
	    echo '        Inverse Flattening ................... ' ,
	         $ref->getReferenceEllipsoid()->getInverseFlattening() , PHP_EOL;
	    echo '        First Eccentricity ................... ' ,
	         $ref->getReferenceEllipsoid()->getFirstEccentricity() , PHP_EOL;
	    echo '        First Eccentricity Squared ........... ' ,
	         $ref->getReferenceEllipsoid()->getFirstEccentricitySquared() , PHP_EOL;
	    echo '        Second Eccentricity .................. ' ,
	         $ref->getReferenceEllipsoid()->getSecondEccentricity() , PHP_EOL;
	    echo '        Second Eccentricity Squared .......... ' ,
	         $ref->getReferenceEllipsoid()->getSecondEccentricitySquared() , PHP_EOL;

	    echo '    Regions' , PHP_EOL;
	    foreach(\Geodetic\Datum::getRegionNamesForDatum($datum) as $region) {
	        echo '        ' , $region , PHP_EOL;
	    }
	    echo '    Default Region ........................... ' , $ref->getRegionName() , PHP_EOL;

	    echo '    Bursa-Wolf Parameters for the Helmert Transformation' , PHP_EOL;
	    echo '        Translation Vectors',PHP_EOL;
	    echo '            X ................................ ' ,
	         $ref->getBursaWolfParameters()->getTranslationVectors()->getX()->getValue(\Geodetic\Distance::METRES) ,
	         ' ' , \Geodetic\Distance::METRES ,
	         PHP_EOL;
	    echo '            Y ................................ ' ,
	         $ref->getBursaWolfParameters()->getTranslationVectors()->getY()->getValue(\Geodetic\Distance::METRES) ,
	         ' ' , \Geodetic\Distance::METRES ,
	         PHP_EOL;
	    echo '            Z ................................ ' ,
	         $ref->getBursaWolfParameters()->getTranslationVectors()->getZ()->getValue(\Geodetic\Distance::METRES) ,
	         ' ' , \Geodetic\Distance::METRES ,
	         PHP_EOL;
	    echo '        Scale Factor ......................... ' ,
	         $ref->getBursaWolfParameters()->getScaleFactor() , ' ppm' , PHP_EOL;
	    echo '        Rotation Matrix' , PHP_EOL;
	    echo '            X ................................ ' ,
	         $ref->getBursaWolfParameters()->getRotationMatrix()->getX()->getValue(\Geodetic\Angle::ARCSECONDS) ,
	         ' ' , \Geodetic\Angle::ARCSECONDS ,
	         PHP_EOL;
	    echo '            Y ................................ ' ,
	         $ref->getBursaWolfParameters()->getRotationMatrix()->getY()->getValue(\Geodetic\Angle::ARCSECONDS) ,
	         ' ' , \Geodetic\Angle::ARCSECONDS ,
	         PHP_EOL;
	    echo '            Z ................................ ' ,
	         $ref->getBursaWolfParameters()->getRotationMatrix()->getZ()->getValue(\Geodetic\Angle::ARCSECONDS) ,
	         ' ' , \Geodetic\Angle::ARCSECONDS ,
	         PHP_EOL;
	} catch (Exception $e) {
		echo $e->getMessage();
	}

    echo PHP_EOL;
}

