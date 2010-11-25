<?php

use \GoogleMaps\Service\Geocoder;

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$map = new \GoogleMaps\Map;

$polygon_paths = array(
	Geocoder::getLatLng( 'San Diego, CA' ),
	Geocoder::getLatLng( 'Austin, TX' ),
	Geocoder::getLatLng( 'New Haven, CT' ),
	Geocoder::getLatLng( 'Seattle, WA' )
);

$polygon_options = array(
	'strokeColor'	=> '#0000ff',
	'fillColor'		=> '#230754'
);

$polygon = new \GoogleMaps\Overlay\Polygon( $polygon_paths, $polygon_options );

$m = \GoogleMaps\Overlay\Marker::createFromLatLng( $polygon->getCenter() );

$map->disableAutoEncompass();
$map->setCenterByLocation( 'Austin, TX' );
$map->setZoom( 3 );

$map->addObjects( array( $polygon, $m ) );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Polygons - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Polygons</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
