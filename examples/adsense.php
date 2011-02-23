<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
require( '_system/config.php' );


$map = new \PHPGoogleMaps\Map;
$map->enableAdsense( 'pub-9317852351271673', 'small_rectangle' );
$map->setCenter( 'New York, NY' );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Adsense - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Adsense</h1>
<p>You can specify ad format and ad position.</p>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>

</body>

</html>
