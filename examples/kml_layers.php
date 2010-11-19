<?php

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$map = new \GoogleMaps\Map;

$kml = new \GoogleMaps\Layer\KmlLayer( 'http://maps.google.com/maps/ms?msa=0&msid=114680467578999980893.00049426282c85822d40e&output=kml' );

$map->addObject( $kml );

?>

<!DOCTYPE html>
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


