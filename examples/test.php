<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;
use \PHPGoogleMaps\Overlay\Marker;

for ( $i=0;$i<100;$i++ ) {
	$marker = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( new \PHPGoogleMaps\Core\LatLng( mt_rand(30,48), mt_rand(69,120) ), array( 'animation' => 'drop' ) );
	$map->addObject( $marker );
}
$map->staggerMarkers( 50 );


?>

<!DOCTYPE html>
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

</body>

</html>
