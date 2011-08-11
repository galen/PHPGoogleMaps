<?php

// This is for the examples
require( '_system/config.php' );

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;
$map->enableStreetView();
$map->setCenter('Anchorage, AK');

$map2 = new \PHPGoogleMaps\Map( array( 'map_id' => 'map2' ) );
$map2->enableStreetView( array( 'addressControl' => false, 'enableCloseButton' => false ), 'container' );
$map2->setCenter('San Diego, CA');

$map3 = new \PHPGoogleMaps\Map( array( 'map_id' => 'map3', 'center' => 'New Haven, CT' ) );
try {
	$map3->enableStreetView( array( 'position' => 'New Haven, CT' ) );
}
catch ( GeocodeException $e ) {
	echo $e->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Streetview - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
	<?php $map2->printMapJS() ?>
	<?php $map3->printMapJS() ?>
	<style type="text/css">
	#map2, #container { float:left }
	</style>
</head>
<body>

<h1>Streetview</h1>
<?php require( '_system/nav.php' ) ?>

<h2>Same Container</h2>
<?php $map->printMap() ?>
<hr>
<h2>Different Container</h2>
<?php $map2->printMap() ?>
<div id="container" style="width:500px;height:500px;"></div>

<hr style="clear:both">
<h2>Auto Open</h2>
<?php $map3->printMap() ?>

</body>

</html>


