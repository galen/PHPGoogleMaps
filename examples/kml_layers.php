<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Layer\KmlLayer',
	'\PHPGoogleMaps\Layer\KmlLayerDecorator'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;
$kml = new \PHPGoogleMaps\Layer\KmlLayer( 'http://local.yahooapis.com/MapsService/rss/trafficData.xml?appid=YahooDemo&city=new+york' );
$map->addObject( $kml );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>KML Layers - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>KML Layers</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<a href="#" onclick="<?php echo $kml->getJsVar() ?>.setMap(null)">Remove KML Layer</a>

</body>

</html>


