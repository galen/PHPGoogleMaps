<?php

namespace PHPGoogleMaps\Overlay;

use PHPGoogleMaps\Utility;

/**
 * Marker class for adding markers to a map
 * 
 * Markers can be created in 3 different ways
 *
 * Use the static `createFromPosition()` method
 * $marker = \PHPGoogleMaps\Overlay\Marker::createFromPosition( $position, $options );
 *
 * Use the static `createFromLocation()` method which will geocode the location for you
 * $marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( $location, $options );
 *
 * Use the static `createFromUserLocation()` method which will attempt to geolocate the
 * user's position using HTML5's geolocation API {@link http://dev.w3.org/geo/api/spec-source.html}
 * $marker = \PHPGoogleMaps\Overlay\Marker::createFromUserLocation( $title, $content );
 */

class Marker extends \PHPGoogleMaps\Core\StaticMapObject {

	/**
	 * Position of the marker
	 *
	 * @var PositionAbstract
	 */
	protected $position;

	/**
	 * Geolocation flag
	 * If this is true the marker position will be geolocated
	 *
	 * @var boolean
	 */
	protected $geolocation = false;
	
	/**
	 * The marker's icon
	 *
	 * @var MarkerIcon
	 */
	protected $icon;
	
	/**
	 * The marker's icon shadow
	 *
	 * @var MarkerIcon
	 */
	protected $shadow;

	/**
	 * The marker's shape
	 *
	 * @var MarkerShape
	 */
	protected $shape;

	/**
	 * The marker's groups
	 *
	 * @var array
	 */
	protected $groups = array();

	/**
	 * Marker constructor
	 * Initializes the marker options
	 *
	 * This is private, you must use a static creation method
	 *
	 * @param mixed $position Position of the marker. This will be null for geolocated markers.
	 * @param array options Array of marker options
	 * @return Marker
	*/
	private function __construct( $position=null, array $options=null ) {
		if ( $options ) {
			unset( $options['map'] );
		}
		$this->position = $position;
		if ( !$options ) {
			return;
		}
		foreach( $options as $option_name => $option ) {
			switch( $option_name ) {
				case 'group':
					$this->addToGroup( $option );
					break;
				case 'groups':
					$this->addToGroups( $option );
					break;
				case 'icon':
					$this->setIcon( $option );
					break;
				case 'static':
					$this->static = (object)$option;
					break;
				case 'shadow':
					$this->setShadow( $option );
					break;
				case 'shape':
					$this->setShape( $option );
				case 'geolocation':
					if ( $position === null && $option ) {
						$timeout = isset( $options['geolocation_timeout'] ) ? $options['geolocation_timeout'] : null;
						$high_accuracy = isset( $options['geolocation_high_accuracy'] ) ? $options['geolocation_high_accuracy'] : null;
						$this->enableGeolocation( $timeout, $high_accuracy );
					}
					break;
				default:
					$this->options[$option_name] = $option;
			}
		}
	}

	/**
	 * Add marker to a group
	 *
	 * @param string|MarkerGroup $group Can be a Markergroup or a string
	 * @return Marker
	 */
	function addToGroup( $group ) {
		if ( $group instanceof MarkerGroup ) {
			$this->groups[] = $group;
		}
		else {
			$this->groups[] = new MarkerGroup( $group );
		}
		return $this;
	}

	/**
	 * Add marker to an array of groups
	 *
	 * @param array $groups
	 * @return Marker
	 */
	function addToGroups( array $groups ) {
		foreach( $groups as $group ) {
			$this->addToGroup( $group );
		}
		return $this;
	}

	/**
	 * Sets the marker's icon and optionally shadow
	 *
	 * @param MarkerIcon $icon The marker's icon.
	 * @return Marker
	 */
	public function setIcon( $icon ) {
		if ( !$icon instanceof MarkerIcon ) {
			$icon = new MarkerIcon( $icon );
		}
		$this->icon = $icon;
		return $this;
	}

	/**
	 * Get the url of the marker's icon
	 *
	 * @return string
	 */
	public function getIcon() {
		if ( isset( $this->icon->icon ) ) {
			return $this->icon->icon;
		}
		return null;
	}

	/**
	 * Get the url of the marker's shadow
	 *
	 * @return string
	 */
	public function getShadow() {
		if ( isset( $this->shadow->icon ) ) {
			return $this->shadow->icon;
		}
		return null;
	}

	/**
	 * Sets the marker's shadow
	 *
	 * @param MarkerIcon $shadow The marker's shadow.
	 * @return Marker
	 */
	public function setShadow( $shadow ) {
		if ( !$shadow instanceof MarkerIcon ) {
			$shadow = new MarkerIcon( $shadow );
		}
		$this->shadow = $shadow;
		return $this;
	}

	/**
	 * Sets the marker's shape
	 *
	 * @param MarkerShape $shape The marker's shape.
	 * @return MarkerShape
	 */
	public function setShape( MarkerShape $shape ) {
		$this->shape = $shape;
		return $this;
	}

	/**
	 * Enable marker geolocation
	 *
	 * Use `createMarkerFromUserLocation()`
	 *
	 * @access private
	 * @return MarkerIcon
	 */
	private function enableGeolocation() {
		$this->geolocation = true;
		return $this;
	}

	/**
	 * Return the marker's geolocation flag
	 *
	 * @return boolean
	 */
	public function isGeolocated() {
		return $this->geolocation;
	}

	/**
	 * Factory method to create a marker from a position (LatLng or GeocodeResult)
	 *
	 * @param AbstractPosition $position Position of the marker
	 * @param array $options Array of marker options
	 * @return Marker
	 */
	public static function createFromPosition( \PHPGoogleMaps\Core\PositionAbstract $position, array $options=null ) {
		return new Marker( $position->getLatLng(), $options );
	}

	/**
	 * Factory method to create a marker from a location ( e.g. New York, NY )
	 *
	 * @param string $location Location of the marker. This will be geocoded for you.
	 * @param array $options Array of marker options.
	 * @return Marker|False Will return false if geocoding fails.
	 * @throws GeocodeException
	 */
	public static function createFromLocation( $location, array $options=null ) {
		$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $location );
		if ( $geocode_result instanceof \PHPGoogleMaps\Service\GeocodeResult ) {
			return self::createFromPosition( $geocode_result, $options );
		}
		else {
			throw new \PHPGoogleMaps\Service\GeocodeException( $geocode_result );
		}
	}

	/**
	 * Factory method to create a marker from the user's location
	 * This uses HTML5's geolocation API
	 *
	 * @param array options Array of marker options
	 * @return Marker
	 */
	public static function createFromUserLocation( array $options=null ){
		$marker = new Marker( null, $options );
		$marker->enableGeolocation();
		return $marker;
	}

	/**
	 * Return the markers position
	 *
	 * @return LatLng|null
	 */
	function getPosition() {
		return $this->position;
	}

}

