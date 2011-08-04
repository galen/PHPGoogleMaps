<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Layer\PanoramioLayer',
	'\PHPGoogleMaps\Layer\PanoramioLayerDecorator'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;
$panoramio = new \PHPGoogleMaps\Layer\PanoramioLayer;
$panoramio->setTag( 'beach' );
//$panoramio->setUserID( 4106947 );

$map->addObject( $panoramio );
$map->setCenter( 'San Diego, CA' );
$map->setZoom( 10 );
$map->disableAutoEncompass();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Panoramio - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Panoramio Layer</h1>
<?php require( '_system/nav.php' ) ?>

<p>Implementation of the <a href="http://code.google.com/apis/maps/documentation/javascript/overlays.html#PanoramioLibrary">Google Panoramio Library</a>.</p>

<p>You can set a user_id or tag to limit the visible photos, but not both.</p>

<?php $map->printMap() ?>

</body>

</html>


