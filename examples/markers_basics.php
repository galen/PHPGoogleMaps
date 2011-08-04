<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerDecorator'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;

$marker1_options = array(
	'title'	=> 'New York, NY',
	'content'	=> '<p><strong>New York, NY info window</strong></p>'
);
$marker1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY', $marker1_options );

$marker2_options = array(
	'title'	=> 'San Diego, CA',
	'content'	=> '<p><strong>San Diego, CA info window</strong></p>'
);
$marker2 = \PHPGoogleMaps\Overlay\Marker::createFromPosition( new \PHPGoogleMaps\Core\LatLng( 32.7153292,-117.1572551 ), $marker2_options );

// Add both markers to the map
// We need to be able to remove marker1 so we get a decorator for it
$marker1_map = $map->addObject( $marker1 );
$map->addObject( $marker2 );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Marker Basics - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Marker Basics</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>
<a href="#" onclick="<?php echo $marker1_map->getJsVar() ?>.setMap(null); return false;">Hide New York marker</a>
</body>

</html>
