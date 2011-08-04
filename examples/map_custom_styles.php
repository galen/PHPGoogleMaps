<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\MapStyle'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$custom_style_json = '[ { featureType: "water", elementType: "all", stylers: [ { hue: "#ff0008" }, { saturation: 71 }, { lightness: -43 }, { gamma: 0.83 } ] },{ featureType: "road", elementType: "all", stylers: [ { saturation: -24 }, { hue: "#1100ff" } ] },{ featureType: "landscape", elementType: "all", stylers: [ { hue: "#11ff00" }, { saturation: 100 }, { lightness: -34 } ] } ]';
$custom_style = new \PHPGoogleMaps\Overlay\MapStyle( 'Custom', $custom_style_json );

$map = new \PHPGoogleMaps\Map;

$map->addObject( $custom_style );

// You must explicitly set the map types and include the custom style
$map->setMapTypes( array( 'roadmap', 'terrain', $custom_style ) );

$map->setCenter( 'San Diego, CA' );
$map->setZoom( 14 );

?>

<!DOCTYPE html>
<html lang="en">
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
