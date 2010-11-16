<?php

require( '../google_maps.php' );
require( '_system/config.php' );

$map = new \googlemaps\GoogleMap();

$marker1 = \googlemaps\overlay\Marker::createFromLocation( 'New York, NY', array( 'title' => 'New York, NY', 'content' => '<p><strong>New York, NY info window</strong></p>' ) );
$marker2 = \googlemaps\overlay\Marker::createFromLatLng( new \googlemaps\core\LatLng( 32.7153292,-117.1572551 ), array( 'title' => 'San Diego, CA', 'content' => '<p><strong>San Diego, CA info window</strong></p>' ) );

$map->addObjects( array( $marker1, $marker2 ) );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Custom Map Styles - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Custom Map Styles</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
