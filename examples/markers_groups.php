<?php

require( '../PHPGoogleMaps/PHPGoogleMaps.php' );
require( '_system/config.php' );

$map = new \GoogleMaps\Map;

$ny1 = \GoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY' );
$ny2 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Syracuse, NY' );

$ca1 = \GoogleMaps\Overlay\Marker::createFromLocation( 'San Diego, CA' );
$ca2 = \GoogleMaps\Overlay\Marker::createFromLocation( 'San Francisco, CA' );

$tx1 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Houston, TX' );
$tx2 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Dallas, TX' );

$fl1 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Orlando, FL' );
$fl2 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Tampa, FL' );

$mi1 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Detroit, MI' );
$mi2 = \GoogleMaps\Overlay\Marker::createFromLocation( 'Ann Arbor, MI' );

$group_ny = \GoogleMaps\Overlay\MarkerGroup::create( 'New York' )->addMarkers( array( $ny1, $ny2 ) );
$group_ca = \GoogleMaps\Overlay\MarkerGroup::create( 'California' )->addMarkers( array( $ca1, $ca2 ) );
$group_tx = \GoogleMaps\Overlay\MarkerGroup::create( 'Texas' )->addMarkers( array( $tx1, $tx2 ) );
$group_fl = \GoogleMaps\Overlay\MarkerGroup::create( 'Florida' )->addMarkers( array( $fl1, $fl2 ) );
$group_mi = \GoogleMaps\Overlay\MarkerGroup::create( 'Michigan' )->addMarkers( array( $mi1, $mi2 ) );

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
