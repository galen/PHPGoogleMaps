<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;
$panoramio_options = array(
	'tag'		=> 'beach'
);
$panoramio = new \PHPGoogleMaps\Layer\PanoramioLayer( $panoramio_options );

$map->addObject( $panoramio );
$map->setCenter( 'San Diego, CA' );
$map->setZoom( 16 );
$map->disableAutoEncompass();
$map->setApiVersion(3.4);
?>

<!DOCTYPE html>
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

<?php $map->printMap() ?>

</body>

</html>


