<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map_options = array(
	'map_id'		=> 'map23',
	'draggable'		=> false,
	'center'		=> 'San Diego, CA',
	'height'		=> '600px',
	'width'			=> '600px',
	'zoom'			=> 10,
	'bicycle_layer'	=> true
);
$map = new \PHPGoogleMaps\Core\Map( $map_options );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Map Options - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Map Options</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
