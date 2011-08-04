<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerDecorator'
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
	$marker_decorator = $map->addObject( $marker );
	
	// You have to add the event handler after the marker has been added to a map
	$click_handler = new \PHPGoogleMaps\Event\EventListener( $marker_decorator, 'click', 'function(){alert("You clicked " + '. $marker_decorator .'.content);}' );
	$map->addObject( $click_handler );
}

// Diable infowindows so that only the alternate click handler gets triggered
$map->disableInfoWindows();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Alternate Click Handlers - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Alternate Click Handlers</h1>
<?php require( '_system/nav.php' ) ?>

<p>Steps for creating alternate click handlers</p>
<ol>
	<li>Create a marker and add it to the map
		<pre>
$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( $location,
	array(
		'title' => 'title',
		'content' => 'content'
	)
);
$map->addObject( &$marker );
		</pre>
	</li>
	<li>Create an event listener with the alternate click handler for the marker and and add that to the map
	<pre>
$click_handler = new \PHPGoogleMaps\Event\EventListener( $marker, 'click', 'function(){alert("You clicked " + '. $marker .'.content);}' );
$map->addObject( $click_handler );
	</pre>
	</li>
	<li>Optionally disable infowindows
	<pre>$map->disableInfoWindows();</pre>
	</li>
</ol>

<?php $map->printMap() ?>

</body>

</html>
