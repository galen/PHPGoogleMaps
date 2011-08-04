<?php

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

// This is just for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Event\EventListener',
	'\PHPGoogleMaps\Event\DomEventListener',
	'\PHPGoogleMaps\Event\EventListenerDecorator'
);

// Create new map
$map = new \PHPGoogleMaps\Map;

// Create 2 events
$event1 = new \PHPGoogleMaps\Event\EventListener( $map, 'idle', 'function(){alert("the map is loaded");}', true );
$event2 = new \PHPGoogleMaps\Event\EventListener( $map, 'click', 'add_marker');

// Create a DOM event
$dom_event1 = new \PHPGoogleMaps\Event\DomEventListener( 'add_random_marker', 'click', 'add_random_marker' );

$map->addObjects( array( $event1, $dom_event1 ) );
// Add this event with addObject() so we can use the return value to remove the event
$event2_map = $map->addObject( $event2 );

// Set map options
$map->setCenter( 'San Diego, CA' );
$map->setZoom( 14 );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Event Listeners - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<script type="text/javascript">
	function add_marker( event ) {
		markers = [];
		var marker = new google.maps.Marker({
			position: event.latLng,
			animation: google.maps.Animation.DROP,
			map: <?php echo $map->getJsVar() ?>
		});
		markers.push(marker);
		var info_window = <?php echo $map->getInfoWindowJsVar() ?>;
		google.maps.event.addListener(
			marker,
			'click',
			function() {
				info_window.setContent('You clicked: ' + event.latLng.lat() + ', ' + event.latLng.lng());
				info_window.open(<?php echo $map->getJsVar() ?>,marker);
			}
		);
		return false;
	}
	function add_random_marker() {
		lat_sw = <?php echo $map->getJsVar() ?>.getBounds().getSouthWest().lat();
		lng_sw = <?php echo $map->getJsVar() ?>.getBounds().getSouthWest().lng();
		lat_ne = <?php echo $map->getJsVar() ?>.getBounds().getNorthEast().lat();
		lng_ne = <?php echo $map->getJsVar() ?>.getBounds().getNorthEast().lng();
		lat_diff = lat_ne - lat_sw;
		lng_diff = lng_ne - lng_sw;
		new_lat = lat_sw + Math.random()*lat_diff;
		new_lng = lng_sw + Math.random()*lng_diff;
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng( new_lat, new_lng ),
			animation: google.maps.Animation.DROP,
			map: <?php echo $map->getJsVar() ?>
		});
		var info_window = <?php echo $map->getInfoWindowJsVar() ?>;
		google.maps.event.addListener(
			marker,
			'click',
			function() {
				info_window.setContent('Random marker added: ' + new_lat + ', ' + new_lng);
				info_window.open(<?php echo $map->getJsVar() ?>,marker);
			}
		);
		return false;
	}
	</script>
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Event Listeners</h1>
<?php require( '_system/nav.php' ) ?>

<p>This page has 3 event listeners added:</p>
<ol>
	<li>An alert box will appear when the map is done loading (idle event).</li>
	<li>When the map is clicked a marker will be added at that location.</li>
	<li>When the link under the map is clicked a marker will be placed on the map in a random location.</li>
</ol>

<?php $map->printMap() ?>

<a href="#" id="add_random_marker">Add a random marker</a>, <a href="#" onclick="google.maps.event.removeListener(<?php echo $event2_map->getJsVar() ?>);alert('Map click listener has been removed')">Remove map click listener</a>

</body>

</html>


