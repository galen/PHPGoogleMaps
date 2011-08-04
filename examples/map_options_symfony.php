<?php

// This is for my examples
require( '_system/config.php' );

// This is how you autoload with Symfony
require( '_system/UniversalClassLoader.php' );
use Symfony\Component\ClassLoader\UniversalClassLoader;
$loader = new UniversalClassLoader();
$loader->registerNamespace( 'PHPGoogleMaps', '../' );
$loader->register();

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
	<title>Symfony Class Loader - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Using the Symfony class loader</h1>
<p>This loads a map using <a href="https://github.com/symfony/symfony/blob/master/autoload.php.dist">Symfony's UniversalClassLoader</a></p>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
