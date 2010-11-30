<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );

$map = new \PHPGoogleMaps\Core\Map;

$marker1_options = array(
	'title'		=> 'Custom marker icon',
	'content'	=> 'This marker uses a custom icon'
);
$marker1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY', $marker1_options );
$icon = new \PHPGoogleMaps\Overlay\MarkerIcon( '_images/yellow_marker.png' );
$shadow = new \PHPGoogleMaps\Overlay\MarkerIcon( '_images/yellow_marker_shadow.png' );
$shadow->setAnchor( 11 );
$marker1->setIcon( $icon )->setShadow( $shadow );

$marker2_options = array(
	'title'		=> 'Custom marker icon',
	'content'	=> 'This marker uses a custom icon with a sprite to limit http connections'
);
$marker2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New Haven, CT', $marker2_options );
$icon2 = \PHPGoogleMaps\Overlay\MarkerIcon::create( '_images/purple_marker_sprite.png', array( 'height' => 34 ) );

$shadow2_options = array(
	'height'	=> 24,
	'origin_x'	=> 0,
	'origin_y'	=> 34,
	'anchor_x'	=> 11,
	'anchor_y'	=> 24
);
$shadow2 = new \PHPGoogleMaps\Overlay\MarkerIcon( '_images/purple_marker_sprite.png', $shadow2_options );
$marker2->setIcon( $icon2 )->setShadow( $shadow2 );
$map->addObjects( array( $marker1, $marker2 ) );

?>

<!DOCTYPE html>
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
