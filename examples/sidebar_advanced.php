<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerIcon'
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
	$marker->setIcon( sprintf( "http://www.galengrover.com/projects/php-google-maps/examples/_images/blue%s.png", chr( $i++ + 65 ) ) );
	$map->addObject( $marker );
}

?>

<!DOCTYPE html>
<html lang="en">
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
