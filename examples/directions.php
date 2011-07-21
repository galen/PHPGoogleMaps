<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Service\DrivingDirections',
	'\PHPGoogleMaps\Service\WalkingDirections',
	'\PHPGoogleMaps\Service\BicyclingDirections',
	'\PHPGoogleMaps\Service\Directions',
	'\PHPGoogleMaps\Service\DirectionsDecorator'
);

$map = new \PHPGoogleMaps\Map;
$map->setCenter( 'USA' );
$map->setZoom( 3 );

if ( isset( $_GET['origin'], $_GET['destination'] ) && strlen( $_GET['origin'] ) && strlen( $_GET['destination'] ) ) {
	try {
		$directions = new \PHPGoogleMaps\Service\DrivingDirections( $_GET['origin'], $_GET['destination'] );
		//$directions->addWaypoint( 'Austin, TX' );
		$map->addObject( $directions );
	}
	catch ( \PHPGoogleMaps\Core\GeocodeException $e ) {
		$error = $e;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
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
