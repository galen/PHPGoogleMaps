<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );

if ( isset( $_GET['location'] ) && strlen( $_GET['location'] ) ) {
	$map = new \PHPGoogleMaps\Map;
	
	$geoPDO = new \PHPGoogleMaps\Service\GeocodeCachePDO( 'localhost', 'mysql', 'wowouterspace23', 'development' );
	$caching_geo = new \PHPGoogleMaps\Service\CachingGeocoder( $geoPDO );
	
	$latlng = $caching_geo->geocode( $_GET['location'] );
	$marker = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( $latlng );
	$map->addObject( $marker );
	$map->disableAutoEncompass();
	$map->setZoom( 13 );
	$map->setCenter( $latlng );
}
?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Geocoding - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php if( isset( $map ) ): ?>
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
	<?php endif; ?>
</head>
<body>

<h1>Geocoding</h1>
<?php require( '_system/nav.php' ) ?>

<?php if( isset( $map ) ): ?>
<p>Was in cache: <?php echo $latlng->wasInCache() ? 'yes' : 'no' ?></p>
<p>Was put in cache: <?php echo $latlng->wasPutInCache() ? 'yes' : 'no' ?></p>
<?php endif; ?>

<form action="" method="get">
<label for="location">Enter a location</label>
<input type="text" name="location">
<input type="submit" value=" Geocode ">
</form>

<?php if( isset( $map ) ) $map->printMap() ?>

</body>

</html>


