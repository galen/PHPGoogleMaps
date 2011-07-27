<?php

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

// This is just for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Layer\FusionTable',
	'\PHPGoogleMaps\Layer\FusionTableDecorator'
);

// Create a map
$map = new \PHPGoogleMaps\Map;

// Create a fusion table for CT
$ft_ct_options = array(
	'query' => 'SELECT location FROM 232192 WHERE state_province_abbrev="CT"'
);
$ft_ct = new \PHPGoogleMaps\Layer\FusionTable( 232192, $ft_ct_options );

// Create a fusion table for RI
$ft_ri_options = array(
	'query'	=> 'SELECT location FROM 232192 WHERE state_province_abbrev="RI"'
);
$ft_ri = new \PHPGoogleMaps\Layer\FusionTable( 232192, $ft_ri_options );

// Add the CT fusion table to the map and get the decorator for later use
$ft_ct_map = $map->addObject( $ft_ct );

// Add the RI fusion table to the map
$map->addObject( $ft_ri );

// Set map options
$map->setCenter( 'Connecticut' );
$map->setZoom( 7 );

?>

<!DOCTYPE html>
<html lang="en">
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

<a href="#" onclick="<?php echo $ft_ct_map->getJsVar() ?>.setOptions({heatmap:true})">Make CT a heat map</a>

</body>

</html>


