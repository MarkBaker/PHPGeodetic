# PHPGeodetic - Geodetic library for PHP
PHPGeodetic is a library written in PHP, providing a set of classes for the handling Geodetic of Latitude/Longitude and ECEF coordinates, and conversions between datums

This library provides methods for:

 * Conversion of angles (bearings, latitudes and longitudes) between degrees, radians, minutes, seconds and gradians.
 * Conversion of distance between metres and kilometres, miles, nautical miles, yards, feet, inches and astronomical units.
 * Conversion of areas between square metres, kilometres, hectares, square miles, square yards, acres, etc.
 * Calculation of Reference Ellipsoid derived properties such as eccentricity; mean, authalic and volumetric radii; and radius of curvature in the prime vertical and the meridian 
 * Conversion of positions between Latitude/Longitude and ECEF (Earth-Centred, Earth Fixed); and vice versa.
 * Conversion of positions between Latitude/Longitude and UTM (Universal Transverse Mercator); and vice versa.
 * Helmert Translations for conversion between datums.
 * Great Circle distance calculations using either the Haversine or Vincenty formulae.
 * Calculation of Initial and final bearings, and midpoint value for great circle routes.
 * Calculation of destinations from a start point, initial bearing and distance.
 * Calculation of perimeter, area and centrepoint for regions on an ellipsoid


## Requirements
 * PHP version 5.3.0 or higher


## Installation

We recommend installing this package with [Composer](https://getcomposer.org/ "Get Composer").

### Via composer

In your project root folder, execute

```
composer require markbaker/phpgeodetic:dev-master
```

You should now have the files `composer.json` and `composer.lock` as well as the directory `vendor` in your project directory.

You can then require the Composer autoloader from your code

```
require 'vendor/autoload.php';
```


Or, if you already have a composer.json file, then require this package in that file

```
"require": {
    "markbaker/phpgeodetic": "dev-master"
}
```

and update composer.

```
composer update
```

### From Phar

Although we strongly recommend using Composer, we also provide a [Phar archive](http://php.net/manual/en/book.phar.php "Read about Phar") builder that will create a Phar file containing all of the library code.

The phar builder script is in the repository root folder, and can be run using

```
php buildPhar.php
```

To use the archive, just require it from your script:

```
require 'Geodetic.phar';
```

### Standard Autoloader

If you want to run the code without using composer's autoloader, and don't want to build the phar, then required the `bootstrap.php` file from the repository in your code, and this will enable the autoloader for the library.

```
require 'bootstrap.php';
```


## Want to contribute?
Fork this library!


## License
PHPGeodetic is licensed under [LGPL (GNU LESSER GENERAL PUBLIC LICENSE)](https://github.com/MarkBaker/PHPGeodetic/blob/master/LICENSE.md)
