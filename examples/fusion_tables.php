<?php

require( '../google_maps.php' );
require( '_system/config.php' );

$map = new \googlemaps\GoogleMap();

$ft_options = array(
	'query' => 'SELECT location FROM 232192 WHERE state_province_abbrev="CT"'
);
$ft = new \googlemaps\layer\FusionTable( 232192, $ft_options );

$map->addObjects( array( $ft ) );
$map->setCenterByLocation( 'Connecticut' );
$map->setZoom( 8 );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Fusion Tables - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Fusion Tables</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>


