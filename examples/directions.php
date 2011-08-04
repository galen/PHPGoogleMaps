<?php

// This is just for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Service\DrivingDirections',
	'\PHPGoogleMaps\Service\WalkingDirections',
	'\PHPGoogleMaps\Service\BicyclingDirections',
	'\PHPGoogleMaps\Service\Directions',
	'\PHPGoogleMaps\Service\DirectionsDecorator'
);

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

// Create a new map and set some options
$map = new \PHPGoogleMaps\Map;
$map->setCenter( 'USA' );
$map->setZoom( 3 );

// If origin and destination are set add directions
if ( isset( $_GET['origin'], $_GET['destination'] ) && strlen( $_GET['origin'] ) && strlen( $_GET['destination'] ) ) {
	try {
		$directions = new \PHPGoogleMaps\Service\DrivingDirections( $_GET['origin'], $_GET['destination'] );
		if ( isset( $_GET['waypoint'] ) && $_GET['waypoint'] != '' ) {
			$directions->addWaypoint( $_GET['waypoint'] );
		}
		$map->addObject( $directions );
	}
	catch ( \PHPGoogleMaps\Service\GeocodeException $e ) {
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
	<label>Origin:</label><br><input type="text" name="origin" value="<?php echo isset( $_GET['origin'] ) ? $_GET['origin'] : '' ?>"><br>
	<label>Waypoint:</label><br><input type="text" name="waypoint" value="<?php echo isset( $_GET['waypoint'] ) ? $_GET['waypoint'] : '' ?>"><br>
	<label>Destination:</label><br><input type="text" name="destination" value="<?php echo isset( $_GET['destination'] ) ? $_GET['destination'] : '' ?>">
	<input type="submit" value=" Get Directions ">
</form>
<p><?php if( isset( $directions ) ): ?><strong><?php echo $_GET['origin'] ?></strong> to <strong><?php if( $_GET['waypoint'] != '' ): ?><?php echo $_GET['waypoint'] ?></strong> to <?php endif; ?><strong><?php echo $_GET['destination'] ?></strong><?php endif; ?></p>
<?php if( isset( $error ) ): ?><p class="error">Unable to geocode "<?php echo $error->location ?>": <?php echo $error->error ?></p><?php endif; ?>

<?php $map->printMap() ?>

</body>

</html>
