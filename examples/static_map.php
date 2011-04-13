<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;
$map2 = new \PHPGoogleMaps\Map( array( 'map_id' => 'map2' ) );
$map3 = new \PHPGoogleMaps\Map( array( 'map_id' => 'map3' ) );

$locations = array(
	'New York, NY',
	'San Diego, CA',
	'Miami, FL',
	'Chicago, IL',
	'Las Vegas, NV',
	'Austin, TX',
	'Portland, OR',
	'Washington, D.C.'
);

$marker_sizes = array( 'tiny', 'mid', 'small', 'normal' );

foreach( $locations as $i => $location ) {
	$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( $location,
		array(
			'static' => array(
				'label' => substr( $location, 0, 1 ),
				'color' => sprintf( '0x%s%s%s', dechex( str_pad( mt_rand( 0, 255 ), 2, '0' ) ), dechex( str_pad( mt_rand( 0, 255 ), 2, '0' ) ), dechex( str_pad( mt_rand( 0, 255 ), 2, '0' ) ) ),
				'size' => $marker_sizes[array_rand( $marker_sizes )]
			)
		)
	);
	$map->addObject( $marker );
	$map2->addObject( $marker );
}

$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New Haven, CT');
$icon = new \PHPGoogleMaps\Overlay\MarkerIcon( 'http://galengrover.com/projects/php-google-maps/examples/_images/bullseye_marker.png' );
$marker->setStaticVar( 'flat', true );
$marker->setIcon( $icon );

$marker2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY');
$icon2 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'http://galengrover.com/projects/php-google-maps/examples/_images/yellow_marker.png' );
$marker2->setIcon( $icon2 );

$map3->addObjects( array( $marker, $marker2 ) );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Static Maps - <?php echo PAGE_TITLE ?></title>
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

<h1>Static Maps</h1>
<?php require( '_system/nav.php' ) ?>

<p>As of now only markers are able to be placed on a static map. Paths and polygons coming soon.</p>

<p>This example uses the first letter of the city and a random color/size for each marker added to the map.</p>

<img src="<?php $map->printStaticMap() ?>">

<p>This example uses the same markers as the first but has Alaska, and Brazil passed as a viewport.</p>

<img src="<?php $map2->printStaticMap( null, array( 'Alaska', 'Brazil' ) ) ?>">

<p>This example uses a flat marker. Flat markers are anchored using the center of the image.</p>
<img src="<?php $map3->printStaticMap() ?>">

</body>

</html>
