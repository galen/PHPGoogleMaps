<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;

$marker1_options = array(
	'title'	=> 'New York, NY',
	'content'	=> '<p><strong>New York, NY info window</strong></p>'
);
$marker1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY', $marker1_options );

$marker2_options = array(
	'title'	=> 'San Diego, CA',
	'content'	=> '<p><strong>San Diego, CA info window</strong></p>'
);
$marker2 = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( new \PHPGoogleMaps\Core\LatLng( 32.7153292,-117.1572551 ), $marker2_options );

$map->addObjects( array( &$marker1, $marker2 ) );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Marker Basics - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Marker Basics</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>
<a href="#" onclick="<?php echo $marker1->getJsVar() ?>.setMap(null)">Hide New York marker</a>
</body>

</html>
