<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;

$circle_options = array(
	'fillColor'	=> '#00ff00',
	'strokeWeight'	=> 1,
	'fillOpacity'	=> 0.05,
	'clickable'	=> false
);
$circle = \PHPGoogleMaps\Overlay\Circle::createFromLocation( 'San Diego, CA', 100, $circle_options );

$marker_options = array(
	'title'	=> 'San Diego, CA',
	'content'	=> '<p><strong>San Diego, CA</strong></p>',
	'draggable'	=> true
);
$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'San Diego, CA', $marker_options );

$objects = array( &$circle, &$marker );

$map->addObjects( $objects );
$map->setCenter( 'San Diego, CA' );
$map->setZoom( 15 );
$map->disableAutoEncompass();
$map->bind( $circle, 'center', $marker, 'position' );

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

<p>This map has a circle bound to a marker. If you drag the marker, the circle will go with it.</p>

<?php $map->printMap() ?>

</body>

</html>


