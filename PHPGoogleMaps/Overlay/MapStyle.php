<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Map style class
 * In Google Maps v3 you can define you own map types and customize
 * "the visual display of such elements as roads, parks, and built-up
 * areas to reflect a different style than that used in the default map type"
 * 
 * Example:
 * 
 * 1. Create the JSON code for the style {@link http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html}
 * $green_water_json = '[ { featureType: "water", elementType: "all", stylers: [ { hue: "#08ff00" } ] } ]';
 *
 * 2. Create a new MapStyle object and pass the name and json you just created
 * $green_water_style = new \PHPGoogleMaps\Overlay\MapStyle( 'green H2O', $green_water_json );
 *
 * 3. Add the MapStyle object to the map
 * $map->addObjects( array( $style ) );
 *
 * 4. Explicity set the map types of the map and include your new MapStyle object
 * $map->setMapTypes( array( 'roadmap', 'terrain', $green_water_style ) );
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/maptypes.html#StyledMaps
 * @link http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html
 */

class MapStyle extends \PHPGoogleMaps\Core\MapObject {

	/**
	 * Map style name
	 * This is the name that will show up on the map
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Map style variable name
	 * This is used internally
	 *
	 * @var string
	 */
	protected $var_name;

	/**
	 * Map style
	 * This is the JSON code
	 *
	 * @var string
	 */
	protected $style;

	/**
	 * Constructor
	 *
	 * @param string $name The name of the map style
	 * @param $style JSON code of the style
	 * @return MapStyle
	 */
	public function __construct( $name, $style ) {
		$this->name = $name;
		$this->var_name = preg_replace( '~\W~', '', $name );
		$this->style = $style;
	}

}