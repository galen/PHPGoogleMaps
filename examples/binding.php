<?php

// This is just for my examples
require( '_system/config.php' );

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

// Create a new map
$map = new \PHPGoogleMaps\Map;

// Create some circle options
$circle_options = array(
	'fillColor'		=> '#00ff00',
	'strokeWeight'	=> 1,
	'fillOpacity'	=> 0.05,
	'clickable'		=> false,
	'map'	=>	'adf'
);

// Create a circle with radius of 100m
$circle = \PHPGoogleMaps\Overlay\Circle::createFromLocation( 'San Diego, CA', 100, $circle_options );

// Create some marker options
$marker_options = array(
	'title'		=> 'San Diego, CA',
	'content'	=> '<p><strong>San Diego, CA</strong></p>',
	'draggable'	=> true,
	'map'		=> 'ads'
);

// Create a marker
$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'San Diego, CA', $marker_options );

// Add the circle and marker to the map
$circle_map = $map->addObject( $circle );

$marker_map = $map->addObject( $marker );

// Set map options
$map->setCenter( 'San Diego, CA' );
$map->setZoom( 15 );
$map->disableAutoEncompass();

// bind the center of the circle to the position of the marker
$map->bind( $circle_map, 'center', $marker_map, 'position' );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Binding Objects - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Binding objects</h1>
<?php require( '_system/nav.php' ) ?>

<p>This map has a circle bound to a marker. If you drag the marker, the circle will moveo with it.</p>

<?php $map->printMap() ?>

</body>

</html>


