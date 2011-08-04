<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerDecorator',
	'\PHPGoogleMaps\Event\EventListener'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;

$locations = array(
	'New York, NY',
	'San Diego, CA',
	'Dallas, TX',
	'Seattle, WA',
	'Miami, FL',
	'Atlanta, GA',
	'Boise, ID',
	'Green Bay, WI',
	'Detroit, MI',
	'Denver, CO',
	'Phoenix, AZ',
	'Portland, OR',
	'Chicago, IL',
	'New Orleans, LA',
	'San Francisco, CA',
	'Las Vegas, NV'
);

foreach( $locations as $i => $location ) {
	$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( $location,
		array(
			'title' => $location,
			'content' => "$location marker"
		)
	);
	$map->addObject( $marker );
}

$e = new \PHPGoogleMaps\Event\EventListener( $map, 'click', 'find_closest_marker');
$map->addObject( $e );
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Get Closest Marker to Map Click - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<style type="text/css">
	#map, #map_sidebar { float: left }
	#map_sidebar *, .infowindow * {padding:0;margin:0;}
	#map_sidebar { float:left;margin-left:20px;overflow:auto;height:500px; border:1px solid #ddd;width:200px;font-size:.8em; }
	.sidebar { list-style:none;margin:0;padding:0; }
	.sidebar li { border-bottom: 1px dotted #ddd;padding: 5px 10px !important; cursor:pointer; background-repeat: no-repeat;background-position: 5px 5px;}
	.sidebar li:hover { background-color:#eee; }
	.sidebar .active { background-color:#eee; }
	</style>
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
	<script type="text/javascript">

		//google.maps.event.addListener(map, 'click', find_closest_marker);
		function rad(x) {return x*Math.PI/180;}
		function find_closest_marker( event ) {
		    var lat = event.latLng.lat();
		    var lng = event.latLng.lng();
		    var R = 6371;
		    var distances = [];
		    var closest = -1;
		    for( i=0;i<map.markers.length; i++ ) {
		        var mlat = map.markers[i].position.lat();
		        var mlng = map.markers[i].position.lng();
		        var dLat  = rad(mlat - lat);
		        var dLong = rad(mlng - lng);
		        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
		            Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
		        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
		        var d = R * c;
		        distances[i] = d;
		        if ( closest == -1 || d < distances[closest] ) {
		            closest = i;
		        }
		    }
		
		    alert(map.markers[closest].title);
		}

	</script>
</head>
<body>

<h1>Get Closest Marker to Map Click</h1>
<?php require( '_system/nav.php' ) ?>

<p>This example is in response to a <a href="http://stackoverflow.com/questions/4057665/google-maps-api-v3-find-nearest-markers">question asked on Stackoverflow</a>.</p>

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
