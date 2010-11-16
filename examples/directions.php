<?php

require( '../google_maps.php' );
require( '_system/config.php' );

$map = new \googlemaps\GoogleMap();
$map->setCenterByLocation( 'USA' );
$map->setZoom( 3 );

if ( isset( $_GET['origin'], $_GET['destination'] ) && strlen( $_GET['origin'] ) && strlen( $_GET['destination'] ) ) {
	try {
		$directions = new \googlemaps\overlay\DrivingDirections( $_GET['origin'], $_GET['destination'] );
		$map->addObject( $directions );
	}
	catch ( \googlemaps\core\GeocodeException $e ) {
		$error = $e;
	}
}

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Directions - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Directions</h1>
<?php require( '_system/nav.php' ) ?>

<form action="">
	<label>Origin:</label><input type="text" name="origin" value="<?php echo isset( $_GET['origin'] ) ? $_GET['origin'] : '' ?>">
	<label>Destination:</label><input type="text" name="destination" value="<?php echo isset( $_GET['destination'] ) ? $_GET['destination'] : '' ?>">
	<input type="submit" value=" Get Directions ">
</form>

<?php if( isset( $error ) ): ?><p class="error">Unable to geocode "<?php echo $error->location ?>": <?php echo $error->error ?></p><?php endif; ?>

<?php $map->printMap() ?>

</body>

</html>
