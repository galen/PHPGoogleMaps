<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require( 'google_maps.php' );


$icon1 = \googlemaps\overlay\MarkerIcon::create( 'http://galengrover.com/projects/php-google-maps-v3-api/examples/images/ea_marker.png' );
$shadow1 = \googlemaps\overlay\MarkerIcon::create( 'http://galengrover.com/projects/php-google-maps-v3-api/examples/images/ea_marker_shadow.png', array( 'anchor_x' => 0, 'anchor_y' => 41 ) );


$icon2 = new \googlemaps\overlay\MarkerIcon( 'http://galengrover.com/projects/php-google-maps-v3-api/examples/images/start_sprite.png' );
$icon2->setSize( 38, 34 )->setAnchor( 19, 34 );
$shadow2 = new \googlemaps\overlay\MarkerIcon( 'http://galengrover.com/projects/php-google-maps-v3-api/examples/images/start_sprite.png' );
$shadow2->setHeight( 28 )->setOrigin( 0, 35 )->setAnchor( 10, 28 );

$g = new \googlemaps\overlay\MarkerGroup( 'group 1' );
$ea = new \googlemaps\overlay\MarkerGroup( 'elizabeth arden' );

//$map->enableGeolocation( null, true );
$m1 = \googlemaps\overlay\Marker::createFromCoords( 41.3081527, -72.9281577 );
$m2 = \googlemaps\overlay\Marker::createFromLocation( 'West Haven, CT' );
$m3 = \googlemaps\overlay\Marker::createFromLocation( 'Milford, CT', array( 'title' => 'Milford, CT', 'content' => 'Milford, CT marker content' ) );
//$m4 = new \googlemaps\overlay\Marker( 47,74, 'Milford marker', 'Milford content' );
//print_r($m2);
//print_r($icon1);
//$m1->setIcon($icon1);

$map = new \googlemaps\GoogleMap;

$map->setDefaultMarkerIcon( $icon1, $shadow1 );

//$map2 = new \googlemaps\GoogleMap('map2');

//$del = new \googlemaps\event\DomEventListener( 'click', 'click', 'function(){alert("weeee"); return false;}', true );

//$ft = new \googlemaps\layer\FusionTable( 232192, array( 'query' => 'SELECT location FROM 232192 WHERE state_province_abbrev="CT"' ) );
$kml = new \googlemaps\layer\KmlLayer( 'http://maps.google.com/maps/ms?msa=0&msid=114680467578999980893.00049426282c85822d40e&output=kml' );
//$request = array( 'waypoints' => array( array( 'location' => \googlemaps\service\Geocoder::geocode( 'Phoenix, AZ' ) ) ) );
//$renderer = array( 'draggable' => true );
//$dir = new \googlemaps\overlay\DrivingDirections( 'New York, NY', 'San Jose, CA', $renderer, $request );
$map->addObjects( array( $kml ) );

$r = $map->setCenterByLocation( 'New Haven, CT' );
$map->setZoom( 12 );
//print_r($map->getMarkers());
//print_r($map);
//$map2->addObjects( array( $m1, $m2, $m3 ) );

//print_r($map2);
//print_r($m1);
//$m1->draggable = true;
/*
$map->enableBicycleLayer();
$map->disableScrolling();
$map->disableDragging();

$map->setNavigationControlStyle('small');
$map->setNavigationControlPosition( 'top_right' );
$map->setMapTypeControlStyle('dropdown_menu');
$map->enableScaleControl();
$map->setScaleControlPosition( 'top_right' );
*/
//$map->addDrivingDirections( 'New Haven, CT', 'Las Vegas, NV' );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>asdfasdf</title>
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
	<style type="text/css">
		#map_sidebar *, .infowindow * {padding:0;margin:0;}
		#map { float:left;}
		#map_sidebar { float:left;margin-left:20px;overflow:auto;height:500px; border:1px solid #ddd;width:200px;font-size:.8em; }
		.sidebar { list-style:none;margin:0;padding:0; }
		.sidebar li { border-bottom: 1px dotted #ddd;padding: 5px 10px !important; cursor:pointer}
		.sidebar li:hover { background:#eee; }
	</style>
</head>
<body>

<?php $map->printMap() ?>

<a href="#" onclick="<?php echo $map->getDirections()->getRendererJsVar() ?>.setPanel(document.getElementById('panel'))">test</a>
<div id="panel" style="width:500px;height:500px;"></div>
</body>

</html>
