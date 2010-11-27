<?php

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$map = new \GoogleMaps\Map;

$marker1 = \GoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY',
	array( 'title' => 'New York, NY', 'content' => 'New York marker"' )
)
->setIcon( 'http://www.galengrover.com/projects/php-google-maps/examples/_images/blueA.png' );

$marker2 = \GoogleMaps\Overlay\Marker::createFromLatLng( new \GoogleMaps\Core\LatLng( 32.7153292,-117.1572551 ),
	array( 'title' => 'San Diego, CA', 'content' => 'San Diego marker' )
)
->setIcon( 'http://www.galengrover.com/projects/php-google-maps/examples/_images/blueB.png' );

$marker3 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Dallas, TX',
	array( 'title' => 'Dallas, TX', 'content' => 'Dallas marker' )
)
->setIcon( 'http://www.galengrover.com/projects/php-google-maps/examples/_images/blueC.png' );

$map->addObjects( array( $marker1, $marker2, $marker3 ) );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Advanced Sidebar - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<style type="text/css">
	#map, #map_sidebar { float: left }
	#map_sidebar *, .infowindow * {padding:0;margin:0;}
	#map_sidebar { float:left;margin-left:20px;overflow:auto;height:500px; border:1px solid #ddd;width:200px;font-size:.8em; }
	.sidebar { list-style:none;margin:0;padding:0; }
	.sidebar li { border-bottom: 1px dotted #ddd;padding: 5px 10px 5px 40px !important; cursor:pointer; background-repeat: no-repeat;background-position: 5px 5px;}
	.sidebar li:hover { background-color:#eee; }
	.sidebar .active { background-color:#eee; }
	</style>
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Advanced Sidebar</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<div id="map_sidebar">
	<ul class="sidebar">
<?php foreach( $map->getMarkers() as $n => $marker ): ?>
		<li id="marker<?php echo $n ?>" style="background-image: url(<?php echo $marker->getIcon() ?>)" onclick="<?php echo $marker->getOpener() ?>">
			<h3><?php echo $marker->title ?></h3>
			<p><?php echo $marker->title ?> marker</p>
		</li>
<?php endforeach; ?>
	</ul>
</div>
</body>

</html>
