<?php

require( '../google_maps.php' );
require( '_system/config.php' );

$map = new \googlemaps\GoogleMap();

$ny1 = \googlemaps\overlay\Marker::createFromLocation( 'New York, NY' );
$ny2 = \googlemaps\overlay\Marker::createFromLocation( 'Syracuse, NY' );

$ca1 = \googlemaps\overlay\Marker::createFromLocation( 'San Diego, CA' );
$ca2 = \googlemaps\overlay\Marker::createFromLocation( 'San Francisco, CA' );

$tx1 = \googlemaps\overlay\Marker::createFromLocation( 'Houston, TX' );
$tx2 = \googlemaps\overlay\Marker::createFromLocation( 'Dallas, TX' );

$fl1 = \googlemaps\overlay\Marker::createFromLocation( 'Orlando, FL' );
$fl2 = \googlemaps\overlay\Marker::createFromLocation( 'Tampa, FL' );

$mi1 = \googlemaps\overlay\Marker::createFromLocation( 'Detroit, MI' );
$mi2 = \googlemaps\overlay\Marker::createFromLocation( 'Ann Arbor, MI' );

$group_ny = \googlemaps\overlay\MarkerGroup::create( 'New York' )->addMarkers( array( $ny1, $ny2 ) );
$group_ca = \googlemaps\overlay\MarkerGroup::create( 'California' )->addMarkers( array( $ca1, $ca2 ) );
$group_tx = \googlemaps\overlay\MarkerGroup::create( 'Texas' )->addMarkers( array( $tx1, $tx2 ) );
$group_fl = \googlemaps\overlay\MarkerGroup::create( 'Florida' )->addMarkers( array( $fl1, $fl2 ) );
$group_mi = \googlemaps\overlay\MarkerGroup::create( 'Michigan' )->addMarkers( array( $mi1, $mi2 ) );

$map->addObjects(
	array(
		$ny1, $ny2, $group_ny,
		$ca1, $ca2, $group_ca,
		$tx1, $tx2, $group_tx,
		$fl1, $fl2, $group_fl,
		$mi1, $mi2, $group_mi
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
