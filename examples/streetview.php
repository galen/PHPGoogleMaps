<?php

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$map = new \GoogleMaps\Map;
$map->enableStreetView();
$map->setCenter('New Haven, CT');

$map2 = new \GoogleMaps\Map( array( 'map_id' => 'map2' ) );
$map2->enableStreetView( null, 'container' );
$map2->setCenter('San Diego, CA');

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Streetview - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
	<?php $map2->printMapJS() ?>
	<style type="text/css">
	#map2, #container { float:left }
	</style>
</head>
<body>

<h1>Streetview</h1>
<?php require( '_system/nav.php' ) ?>

<h2>Same container</h2>
<?php $map->printMap() ?>
<hr>
<h2>Different Container</h2>
<?php $map2->printMap() ?>
<div id="container" style="width:500px;height:500px;"></div>
</body>

</html>


