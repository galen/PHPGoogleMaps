#PHP Google Maps API

For PHP 5.3+ and Google Maps API v3

##Features
 - Adsense ads
 - Binding map objects
 - Custom map controls
 - Directions with waypoints ( walking, biking and driving )
 - Event listeners and DOM event listeners
 - Fusion tables
 - Geocoding
 - Geolocation
 - Ground overlays
 - KML layers
 - Custom map styles
 - Markers
 - Marker clustering
 - Custom marker icons
 - Marker staggering
 - Marker animation (bounce, drop)
 - Mobile display
 - Panoramio layers
 - Polygons and polylines
 - Shapes (rectangles and circles)
 - Sidebar
 - Static Map
 - Streetview
 - Simple configuration of map objects

##Autoloading

Use the included autoloader

		require( '../PHPGoogleMaps/Core/Autoloader.php' );
		$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
		$map_loader->register();

This is the autoload from the [PSR-0 Final Proposal](http://groups.google.com/group/php-standards/web/psr-0-final-proposal).
