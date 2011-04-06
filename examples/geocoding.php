<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;

$latlng = \PHPGoogleMaps\Service\Geocoder::geocode( 'San Diego, CA' );
$marker = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( $latlng );
$map->addObject( $marker );
$map->disableAutoEncompass();
$map->setZoom( 13 );
$map->setCenter( $latlng );

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


