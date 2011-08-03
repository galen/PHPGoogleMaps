<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerDecorator',
	'\PHPGoogleMaps\Overlay\MarkerGroup',
	'\PHPGoogleMaps\Overlay\MarkerGroupDecorator'
);

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



/*
// It is also possible to add groups this way, but its not as intuitive
// Marker groups are attached to markers
$group_ny = MarkerGroup::create( 'New York' )->addMarkers( array( $ny1, $ny2 ) );
$group_ca = MarkerGroup::create( 'California' )->addMarkers( array( $ca1, $ca2 ) );
$group_tx = MarkerGroup::create( 'Texas' )->addMarkers( array( $tx1, $tx2 ) );
$group_fl = MarkerGroup::create( 'Florida' )->addMarkers( array( $fl1, $fl2 ) );
$group_mi = MarkerGroup::create( 'Michigan' )->addMarkers( array( $mi1, $mi2 ) );
*/

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
</head>
<body>

<h1>Marker Groups</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

<h2>Marker Groups</h2>
<p>Click a marker group to toggle it.</p>
<?php foreach( $map->getMarkerGroups() as $group ): ?>
<input type="checkbox" value="" checked="checked" onclick="<?php echo $group->getToggleFunction() ?>"><?php echo $group->name ?><br>
<?php endforeach; ?>

</body>

</html>
