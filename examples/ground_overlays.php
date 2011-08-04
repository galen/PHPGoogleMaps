<?php

// This is for the examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\GroundOverlay',
	'\PHPGoogleMaps\Overlay\GroundOverlayDecorator'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;

$go = new \PHPGoogleMaps\Overlay\GroundOverlay(
	'http://www.volunteer.blogs.com/winewaves/images/san_diego_postcard.jpg',
	\PHPGoogleMaps\Service\Geocoder::geocode( 'San Diego, CA' ),
	\PHPGoogleMaps\Service\Geocoder::geocode( 'Balboa Park San Diego, CA' )
);

$map->addObject( $go );
$map->setCenter( \PHPGoogleMaps\Service\Geocoder::geocode( 'San Diego, CA' ) );
$map->setZoom( 14 );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ground Overlays - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Ground Overlays</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<a href="#" onclick="<?php echo $kml->getJsVar() ?>.setMap(null)">Remove KML Layer</a>

</body>

</html>


