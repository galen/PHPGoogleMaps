<?php

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$map = new \GoogleMaps\Map;

$marker1 = \GoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY',
	array( 'title' => 'New York, NY', 'content' => 'New York marker' )
);
$marker2 = \GoogleMaps\Overlay\Marker::createFromLatLng( new \GoogleMaps\Core\LatLng( 32.7153292,-117.1572551 ),
	array( 'title' => 'San Diego, CA', 'content' => 'San Diego marker' )
);
$marker3 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Dallas, TX',
	array( 'title' => 'Dallas, TX', 'content' => 'Dallas marker' )
);

$map->addObjects( array( $marker1, $marker2, $marker3 ) );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Simple Sidebar - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<style type="text/css">
	#map, #map_sidebar { float: left }
	.sidebar { list-style:none; margin:0 0 0 10px;padding:0;width: 200px; }
	.sidebar li { margin-bottom: 2px; }
	.sidebar p { background-color: #eee;margin:0; padding: 5px;cursor: pointer; }
	.sidebar p:hover { background-color: #ddd; }
	</style>
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Simple Sidebar</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<?php echo $map->getSideBar() ?>
</body>

</html>
