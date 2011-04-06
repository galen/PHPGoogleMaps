<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );

$map = new \PHPGoogleMaps\Map;

$ny1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY' );
$ny2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'Syracuse, NY' );

$ca1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'San Diego, CA' );
$ca2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'San Francisco, CA' );

$tx1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'Houston, TX' );
$tx2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'Dallas, TX' );

$fl1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'Orlando, FL' );
$fl2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'Tampa, FL' );

$mi1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'Detroit, MI' );
$mi2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'Ann Arbor, MI' );

$group_ny = \PHPGoogleMaps\Overlay\MarkerGroup::create( 'New York' )->addMarkers( array( $ny1, $ny2 ) );
$group_ca = \PHPGoogleMaps\Overlay\MarkerGroup::create( 'California' )->addMarkers( array( $ca1, $ca2 ) );
$group_tx = \PHPGoogleMaps\Overlay\MarkerGroup::create( 'Texas' )->addMarkers( array( $tx1, $tx2 ) );
$group_fl = \PHPGoogleMaps\Overlay\MarkerGroup::create( 'Florida' )->addMarkers( array( $fl1, $fl2 ) );
$group_mi = \PHPGoogleMaps\Overlay\MarkerGroup::create( 'Michigan' )->addMarkers( array( $mi1, $mi2 ) );

$map->addObjects(
	array(
		$ny1, $ny2,
		$ca1, $ca2,
		$tx1, $tx2,
		$fl1, $fl2,
		$mi1, $mi2
	)
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Marker Groups - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Marker Groups</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<h2>Marker Groups</h2>
<p>Uncheck a marker group to hide it.</p>
<?php foreach( $map->getMarkerGroups() as $group ): ?>
<input type="checkbox" value="" checked="checked" onclick="<?php echo $group->getToggleFunction() ?>"><?php echo $group->name ?><br>
<?php endforeach; ?>

</body>

</html>
