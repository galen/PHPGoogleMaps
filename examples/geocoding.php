<?php

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$map = new \googlemaps\GoogleMap();

$latlng = \googlemaps\service\Geocoder::getLatLng( 'San Diego, CA' );
$marker = new \googlemaps\overlay\Marker( $latlng );
$map->addObject( $marker );
$map->disableAutoEncompass();
$map->setZoom( 13 );
$map->setCenter( $latlng );

?>

<!DOCTYPE html>
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

<p>Geocoding is available in the Geocoder class located in \googlemaps\service\</p>

<?php $map->printMap() ?>

</body>

</html>


