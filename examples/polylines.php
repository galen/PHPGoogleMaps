<?php

use \PHPGoogleMaps\Service\Geocoder;

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;

$polyline_paths = array(
	Geocoder::getLatLng( 'San Diego, CA' ),
	Geocoder::getLatLng( 'Austin, TX' ),
	Geocoder::getLatLng( 'New Haven, CT' ),
	Geocoder::getLatLng( 'Seattle, WA' )
);

$polyline_options = array(
	'strokeColor'	=> '#0000ff',
	'clickable'		=> false
);

$polyline = new \PHPGoogleMaps\Overlay\Polyline( $polyline_paths, $polyline_options );

$polyline->addPath( 'San Francisco, CA' );

$map->disableAutoEncompass();
$map->setCenter( 'Austin, TX' );
$map->setZoom( 3 );

$map->addObjects( array( &$polyline ) );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Polylines - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Polylines</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<a href="#" onclick="<?php echo $polyline->getJsVar() ?>.setMap(null)">Hide polylines</a>
</body>

</html>
