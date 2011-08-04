<?php

// This is just for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Service\Geocoder',
	'\PHPGoogleMaps\Service\GeocodeError',
	'\PHPGoogleMaps\Service\GeocodeResult',
	'\PHPGoogleMaps\Service\GeocodeException'
);

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;

// Geocode a location and set the center of the map
// If geocode fails fallback to a different map center
// If no center is set the map will not display
$geocode = \PHPGoogleMaps\Service\Geocoder::geocode( 'San Diego, CA' );
if ( $geocode instanceof \PHPGoogleMaps\Service\GeocodeResult ) {
	// Set center of map to geocoded location
	$map->setCenter( $geocode );
}
else {
	$map->setCenter( 'New York, NY' );
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

<?php $map->printMap() ?>

</body>

</html>


