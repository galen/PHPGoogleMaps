<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Circle',
	'\PHPGoogleMaps\Overlay\Rectangle',
	'\PHPGoogleMaps\Overlay\Shape',
	'\PHPGoogleMaps\Overlay\ShapeDecorator'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;

$circle_options = array(
	'fillColor'	=> '#00ff00',
	'strokeWeight'	=> 1,
	'fillOpacity'	=> 0.05,
	'clickable'	=> false
);
$circle = \PHPGoogleMaps\Overlay\Circle::createFromLocation( 'San Diego, CA', 1000, $circle_options );

$rectangle_options = array(
	'fillColor'	=> '#ff0000',
	'strokeWeight'	=> 3,
	'fillOpacity'	=> 0.05,
);
$rectangle = new \PHPGoogleMaps\Overlay\Rectangle(
	'San Diego, CA',
	\PHPGoogleMaps\Service\Geocoder::geocode( 'Balboa Park San Diego, CA' ),
	$rectangle_options
);

$map->addObjects( array( $circle, $rectangle ) );
$map->setCenter( 'San Diego, CA' );
$map->setZoom( 14 );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shapes - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Shapes</h1>
<?php require( '_system/nav.php' ) ?>

<p>Simple map example</p>

<?php $map->printMap() ?>

</body>

</html>


