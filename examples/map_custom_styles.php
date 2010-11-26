<?php

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$custom_style_json = '[ { featureType: "water", elementType: "all", stylers: [ { hue: "#ff0008" }, { saturation: 71 }, { lightness: -43 }, { gamma: 0.83 } ] },{ featureType: "road", elementType: "all", stylers: [ { saturation: -24 }, { hue: "#1100ff" } ] },{ featureType: "landscape", elementType: "all", stylers: [ { hue: "#11ff00" }, { saturation: 100 }, { lightness: -34 } ] } ]';
$custom_style = new \GoogleMaps\Overlay\MapStyle( 'Custom', $custom_style_json );

$map = new \GoogleMaps\Map;

$map->addObject( $custom_style );
$map->setMapTypes( array( 'roadmap', 'terrain', $custom_style ) );

$map->setCenter( 'San Diego, CA' );
$map->setZoom( 14 );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Custom Map Styles - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Custom Map Styles</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
