<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;

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
}
//print_r($map->getMarkers());
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Static Map - <?php echo PAGE_TITLE ?></title>
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

<p>This example uses the first letter of the city and a random color/size for each marker added to the map.</p>
<p>As of now only markers are able to be placed on a static map. Paths and polygons coming soon.</p>

<img src="<?php $map->printStaticMap() ?>">


</body>

</html>
