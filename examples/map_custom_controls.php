<?php

// This is for my examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Core\CustomControl'
);

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();


$map = new \PHPGoogleMaps\Map;

$custom_control_outer_options = array (
	'style.backgroundColor'	=> 'white',
  	'style.borderStyle'		=> 'solid',
  	'style.borderWidth'		=> '2px',
  	'style.cursor'			=> 'pointer',
  	'style.textAlign'		=> 'center',
  	'title'					=> 'Click to say hi',
  	'style.margin'			=> '5px'
);

$custom_control_inner_options = array (
  	'style.fontFamily'		=> 'Arial,sans-serif',
  	'style.fontSize'		=> '12px',
  	'style.paddingLeft'		=> '4px',
  	'style.paddingRight'	=> '4px',
  	'innerHTML'				=> '<b>Custom1</b>'
);

// Create a control and add a listener
$custom_control = new \PHPGoogleMaps\Core\CustomControl( $custom_control_outer_options, $custom_control_inner_options, 'BOTTOM_LEFT' );
$custom_control->addListener( 'click', 'function(){ alert("You clicked Custom1"); }' );
$map->addObject( $custom_control );

// Create a control and event, attaching the event to the control
// This has the added benefit of being able to remove the event later using $event

$custom_control_inner_options['innerHTML'] = '<b>Custom2</b>';
$custom_control2 = new \PHPGoogleMaps\Core\CustomControl( $custom_control_outer_options, $custom_control_inner_options, 'BOTTOM_LEFT' );
$custom_control2_map = $map->addObject( $custom_control2 );
$event = new \PHPGoogleMaps\Event\DomEventListener( $custom_control2_map, 'click', 'function(){ alert("You clicked Custom2"); }' );
$map->addObject( $event );

$map->setCenter( 'San Diego, CA' );
$map->setZoom( 14 );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Custom Controls - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Custom Controls</h1>
<?php require( '_system/nav.php' ) ?>

<ol>
	<li>Create styles for the outer and inner parts of the control</li>
	<li>Create the control and pass the style arrays</li>
	<li>Add a listener to the control</li>
	<li>Add the control to the map</li>
</ol>

<?php $map->printMap() ?>

</body>

</html>
