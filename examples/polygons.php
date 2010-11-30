<?php

use \PHPGoogleMaps\Service\Geocoder;

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map = new \PHPGoogleMaps\Core\Map;

$polygon_paths = array(
	Geocoder::getLatLng( 'San Diego, CA' ),
	Geocoder::getLatLng( 'Austin, TX' ),
	Geocoder::getLatLng( 'New Haven, CT' ),
	Geocoder::getLatLng( 'Seattle, WA' )
);

$polygon_options = array(
	'strokeColor'	=> '#0000ff',
	'fillColor'		=> '#230754',
	'clickable'		=> false
);

$polygon = new \PHPGoogleMaps\Overlay\Polygon( $polygon_paths, $polygon_options );

$polygon->addPath( 'San Francisco, CA' );

$m = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( $polygon->getCenter() );

$map->disableAutoEncompass();
$map->setCenter( 'Austin, TX' );
$map->setZoom( 3 );

$map->addObjects( array( &$polygon, $m ) );

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
<a href="#" onclick="<?php echo $polygon->getJsVar() ?>.setMap(null)">Hide polygon</a>
</body>

</html>
