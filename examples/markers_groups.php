<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerDecorator',
	'\PHPGoogleMaps\Overlay\MarkerGroup',
	'\PHPGoogleMaps\Overlay\MarkerGroupDecorator'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

use \PHPGoogleMaps\Overlay\Marker, \PHPGoogleMaps\Overlay\MarkerGroup;

$map = new \PHPGoogleMaps\Map;

$markers[] = Marker::createFromLocation( 'New York, NY' )->addToGroups( array( 'North', 'East', 'New York' ) );
$markers[] = Marker::createFromLocation( 'Syracuse, NY' )->addToGroups( array( 'North', 'East', 'New York' ) );

$markers[] = Marker::createFromLocation( 'San Diego, CA' )->addToGroups( array( 'South', 'West', 'California' ) );
$markers[] = Marker::createFromLocation( 'San Francisco, CA' )->addToGroups( array( 'West', 'California' ) );

$markers[] = Marker::createFromLocation( 'Houston, TX' )->addToGroups( array( 'South', 'Mid West', 'Texas' ) );
$markers[] = Marker::createFromLocation( 'Dallas, TX' )->addToGroups( array( 'South', 'Mid West', 'Texas' ) );

$markers[] = Marker::createFromLocation( 'Orlando, FL' )->addToGroups( array( 'South', 'East', 'Florida' ) );
$markers[] = Marker::createFromLocation( 'Tampa, FL' )->addToGroups( array( 'South', 'East', 'Florida' ) );

$markers[] = Marker::createFromLocation( 'Detroit, MI' )->addToGroups( array( 'North', 'East', 'Michigan' ) );
$markers[] = Marker::createFromLocation( 'Ann Arbor, MI' )->addToGroups( array( 'North', 'East', 'Michigan' ) );

$markers[] = Marker::createFromLocation( 'Seattle, WA' )->addToGroups( array( 'North', 'West' ) );
$markers[] = Marker::createFromLocation( 'Denver, CO' )->addToGroups( array( 'Mid West' ) );

// It is also possible to add groups this way
// Pass an array of markers to `addMarkers()`
// This just calls `addToGroup()` on the marker
//$group_ca = MarkerGroup::create( 'California' )->addMarkers( array() );
//$group_tx = MarkerGroup::create( 'Texas' )->addMarkers( array() );
//$group_fl = MarkerGroup::create( 'Florida' )->addMarkers( array();
//$group_mi = MarkerGroup::create( 'Michigan' )->addMarkers( array() );

// Groups aren't added to map
// The markers associated with them are
$map->addObjects( $markers );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Marker Groups - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
	<script type="text/javascript">
	marker_group_function = function( group_name, f_all, f_group ) {
		for (i in map.markers) {
			var marker = map.markers[i];
			f_all(marker);
		}
		for (i in map.marker_groups[group_name].markers) {
			var marker = map.markers[map.marker_groups[group_name].markers[i]];
			f_group(marker);
		}
	};
	</script>
</head>
<body>

<h1>Marker Groups</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<h2>Marker Groups</h2>
<p>Click a marker group to toggle it.</p>
<?php foreach( $map->getMarkerGroups() as $group ): ?>
<a href="#" onclick="<?php echo $group->callFunction( 'function(m){m.setAnimation(null);}', 'function(m){m.setAnimation(google.maps.Animation.BOUNCE);}' ) ?>; return false;"><?php echo $group->name ?></a><br>
<?php endforeach; ?>

</body>

</html>
