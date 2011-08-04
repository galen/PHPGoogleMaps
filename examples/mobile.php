<?php

// This is for my examples
require( '_system/config.php' );

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;
$marker = \PHPGoogleMaps\Overlay\Marker::createFromUserLocation( array( 'geolocation_high_accuracy' => true, 'geolocation_timeout' => 10000 ) );
$map->addObject( $marker );
$map->centerOnUser( \PHPGoogleMaps\Service\Geocoder::geocode('New Haven, CT') );
$map->setWidth('100%');
$map->setHeight('100%');
$map->enableMobile();
$map->disableAutoEncompass();
$map->setZoom(14);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Geolocation - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<style type="text/css">
	html,body{ height:100%;width:100%;padding:0;margin:0 }
	</style>
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<?php $map->printMap() ?>

</body>

</html>


