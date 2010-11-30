<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map = new \PHPGoogleMaps\Core\Map;
//$marker = \PHPGoogleMaps\Overlay\Marker::createFromUserLocation( array( 'geolocation_high_accuracy' => true, 'geolocation_timeout' => 10000 ) );
$map->addObject( $marker );
$map->enableGeolocation( 5000, true );
$map->centerOnUser( \PHPGoogleMaps\Service\Geocoder::getLatLng('New Haven, CT') );
$map->setWidth('500px');
$map->setHeight('500px');
$map->setZoom(16);
$map->setGeolocationFailCallback( 'geofail' );
$map->setGeolocationSuccessCallback( 'geosuccess' );
?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Geolocation - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
	<script type="text/javascript">
	function geofail() {
		alert( 'geolocation failed' );
	}
	function geosuccess() {
		alert( 'geolocation succeeded' );
	}
	</script>
</head>
<body>

<h1>Geolocation</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>


