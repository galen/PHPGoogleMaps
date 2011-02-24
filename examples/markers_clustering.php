<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;

for ( $i=0;$i<200;$i++ ) {
	$marker = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( new \PHPGoogleMaps\Core\LatLng( mt_rand( 37, 41 )+(mt_rand(100,1000)/1000), mt_rand( -102, -109 )+(mt_rand(100,1000)/1000) ) );
	$map->addObject( $marker );
}
$cluster_options = array(
	'maxZoom' => 8
);
$map->enableClustering( 'http://www.galengrover.com/projects/php-google-maps-dev/examples/_js/markerclusterer.js', $cluster_options );
?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Marker Clustering - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Marker Clustering</h1>
<p>This uses the marker clusterer provided in the <a href="http://code.google.com/p/google-maps-utility-library-v3/wiki/Libraries">Google Maps utility library</a>.</p>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>
<a href="#" onclick="<?php echo $marker1->getJsVar() ?>.setMap(null)">Hide New York marker</a>
</body>

</html>
