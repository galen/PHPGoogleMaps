<?php

// This is for the examples
require( '_system/config.php' );

// Autoload stuff
require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

$map_options = array(
	'map_id'		=> 'map23',
	'draggable'		=> false,
	'center'		=> 'San Diego, CA',
	'height'		=> '600px',
	'width'			=> '600px',
	'zoom'			=> 10,
	'bicycle_layer'	=> true
);
$map = new \PHPGoogleMaps\Map( $map_options );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Map Options - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Map Options</h1>
<p>Map options can be passed to the constructor of the Map object.</p>
<p>There are also getters/setters for each options.</p>

<h2>Options</h2>
<p>If a default isn't provided, the default will be provided by Google.</p>
<ul>
	<li><strong>zoom</strong> default=7</li>
	<li><strong>map_id</strong></li>
	<li><strong>center</strong> this must be set or the map won't load</li>
	<li><strong>language</strong></li>
	<li><strong>region</strong></li>
	<li><strong>sensor</strong> default=false</li>
	<li><strong>api_version</strong> default=3</li>
	<li><strong>auto_encompass</strong></li>
	<li><strong>units</strong></li>
	<li><strong>height</strong> default=500px</li>
	<li><strong>width</strong> default=500px</li>
	<li><strong>center_on_user</strong> default=false</li>
	<li><strong>navigation_control</strong></li>
	<li><strong>navigation_control_position</strong></li>
	<li><strong>navigation_control_style</strong> </li>
	<li><strong>map_type_control</strong></li>
	<li><strong>map_type_control_position</strong></li>
	<li><strong>map_type_control_style</strong></li>
	<li><strong>scale_control</strong></li>
	<li><strong>scale_control_position</strong></li>
	<li><strong>scrollable</strong> default=true</li>
	<li><strong>draggable</strong> default=true</li>
	<li><strong>bicycle_layer</strong></li>
	<li><strong>traffic_layer</strong></li>
	<li><strong>geolocation</strong> default=false</li>
	<li><strong>info_windows</strong></li>
	<li><strong>compress_output</strong> default=false</li>
</ul>
<hr>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
