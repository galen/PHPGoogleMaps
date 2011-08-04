<?php

// This is for my examples
require( '_system/config.php' );

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;

// 
$marker = \PHPGoogleMaps\Overlay\Marker::createFromUserLocation( array( 'geolocation_high_accuracy' => true, 'geolocation_timeout' => 10000 ) );

$map->addObject( $marker );

// If you want to set geolocation options you must call enableGeolocation() explicitly
// Otherwise it will be called for you when you use geolocation functions
$map->enableGeolocation( 5000, true );
$map->centerOnUser( \PHPGoogleMaps\Service\Geocoder::geocode('New York, NY') );
$map->setWidth('500px');
$map->setHeight('500px');
$map->setZoom(16);

// Set the callbacks
$map->setGeolocationFailCallback( 'geofail' );
$map->setGeolocationSuccessCallback( 'geosuccess' );

// Set the loading content. This will display while the browser geolocates the user.
$map->setLoadingContent('<div style="background:#eee;height:300px;padding: 200px 0 0 0;text-align:center;"><img src="_images/loading.gif" style="display:block; margin: auto;"><p>Locating you...</p></div>');
?>

<!DOCTYPE html>
<html lang="en">
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

<p>This example finds your location and centers the map on it. It also uses map::setLoadingContent() to display a loading message to the user.</p>

<?php $map->printMap() ?>

</body>

</html>


