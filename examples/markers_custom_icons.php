<?php

// This is just for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Marker',
	'\PHPGoogleMaps\Overlay\MarkerDecorator',
	'\PHPGoogleMaps\Overlay\MarkerIcon'
);

// Autoloader stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map = new \PHPGoogleMaps\Map;

// Create a marker
$marker1_options = array(
	'title'		=> 'Custom marker icon',
	'content'	=> 'This marker uses a custom icon'
);
$marker1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY', $marker1_options );

// Create a marker icon or the icon and shadow
$icon1 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'http://www.galengrover.com/projects/php-google-maps/examples/_images/yellow_marker.png' );
$shadow1 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'http://www.galengrover.com/projects/php-google-maps/examples/_images/yellow_marker_shadow.png' );

// Set the x anchor point to 11
// y anchor point defaults to image height
$shadow1->setAnchor( 11 );

// Attach the icon and shadow to the marker
$marker1->setIcon( $icon1 )->setShadow( $shadow1 );

// Create another marker
$marker2_options = array(
	'title'		=> 'Custom marker icon',
	'content'	=> 'This marker uses a custom icon with a sprite to limit http connections'
);
$marker2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New Haven, CT', $marker2_options );

// This one will use a sprite for the icon and shadow
$icon2 = \PHPGoogleMaps\Overlay\MarkerIcon::create( 'http://www.galengrover.com/projects/php-google-maps/examples/_images/purple_marker_sprite.png', array( 'height' => 34 ) );

// Height and width default to size of the image
$shadow2_options = array(
	'height'	=> 24,
	'origin_x'	=> 0,
	'origin_y'	=> 34,
	'anchor_x'	=> 11,
	'anchor_y'	=> 24
);

// Create another icon from the same image
$shadow2 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'http://www.galengrover.com/projects/php-google-maps/examples/_images/purple_marker_sprite.png', $shadow2_options );

// Attach the icon and shadow to the second marker
$marker2->setIcon( $icon2 )->setShadow( $shadow2 );

// Add the markers to the map
$map->addObjects( array( $marker1, $marker2 ) );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Custom Marker Icons - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Custom Marker Icons</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
