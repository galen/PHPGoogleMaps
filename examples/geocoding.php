<?php

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

// This is just for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Service\Geocoder',
	'\PHPGoogleMaps\Service\GeocodeError',
	'\PHPGoogleMaps\Service\GeocodeResult'
);

// Create a map
$map = new \PHPGoogleMaps\Map;

// Geocode a location
$geocode = \PHPGoogleMaps\Service\Geocoder::geocode( 'San Diego, CA' );
if ( $geocode instanceof \PHPGoogleMaps\Service\GeocodeResult ) {
	// Set center of map to geocoded location
	$map->setCenter( $geocode );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Geocoding - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Geocoding</h1>
<?php require( '_system/nav.php' ) ?>

<p>Geocoding is available in the Geocoder class located in \PHPGoogleMaps\Service\</p>

<?php $map->printMap() ?>

</body>

</html>


