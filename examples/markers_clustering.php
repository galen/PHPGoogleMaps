<?php

// This is just for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerDecorator'
);

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;
$map->setWidth( 800 );
$map->setHeight( 400 );
$map->setZoom( 2 );
$map->disableAutoEncompass();
$map->setCenterCoords( 39.91, 116.38 );

// Get the photo data from the marker cluster page
$json = json_decode( str_replace( 'var data = ', '', file_get_contents( 'http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/data.json' ) ) );

// Add 1000 markers using the lat/lng from the photo data
for ( $i=0;$i<1000;$i++ ) {
	$marker = \PHPGoogleMaps\Overlay\Marker::createFromPosition( new \PHPGoogleMaps\Core\LatLng( $json->photos[$i]->latitude, $json->photos[$i]->longitude ) );
	$marker->setContent( sprintf( '<img src="%s" style="width: 200px">', $json->photos[$i]->photo_file_url ) );
	$map->addObject( $marker );
}

// Set cluster options
$cluster_options = array(
	'maxZoom' => 10,
	'gridSize' => null
);
$map->enableClustering( 'http://www.galengrover.com/projects/php-google-maps/examples/_js/markerclusterer.js', $cluster_options );
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Marker Clustering - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Marker Clustering</h1>
<p>Marker clustering is provided by the  <a href="http://code.google.com/p/google-maps-utility-library-v3/wiki/Libraries">Google Maps utility library</a>.</p>
<p>This example was taken from <a href="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/examples/advanced_example.html">this page</a></p>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
