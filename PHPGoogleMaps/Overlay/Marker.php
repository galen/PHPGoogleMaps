<?php

namespace PHPGoogleMaps\Overlay;

use PHPGoogleMaps\Utility;

/**
 * Marker class for addign markers to a map
 * 
 * Markers can be created in 3 different ways
 *
 * Use the static `createFromCoords()` method
 * $m = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( $latlng, $title, $content );
 *
 * Use the static `createFromLocation()` method which will geocode the location for you
 * using Google's geocode API
 * $m = \PHPGoogleMaps\Overlay\Marker::createFromLocation( $location, $title, $content );
 *
 * Use the static `createFromUserLocation()` method which will attempt to geolocate the
 * user's position using HTML5's geolocation API {@link http://dev.w3.org/geo/api/spec-source.html}
 * $m = \PHPGoogleMaps\Overlay\Marker::createFromUserLocation( $title, $content );
 */

class Marker extends \PHPGoogleMaps\Core\MapObject {

	/**
	 * Position of the marker
	 *
	 * @var LatLng
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
	 * Animations
	 * Array of valid animations
	 *
	 * @var array
	 */
	protected $animations = array( 'bounce', 'drop' );

	/**
	 * Marker constructor
	 * Initializes the marker options
	 *
	 * @param mixed $position Position of the marker. This will be null for geolocated markers.
	 * @param array options Array of marker options
	 * @return Marker
	*/
	private function __construct( $position=null, array $options=null ) {
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
				case 'animation':
					if ( in_array( $option, $this->animations ) ){
						$this->options['animation'] = sprintf( 'google.maps.Animation.%s', strtoupper( $option ) );
					}
					else {
						$this->options['animation'] = $option;
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
	 * @param MarkerGroup $group
	 * @return Marker
	 */
	function addToGroup( $group ) {
		if ( $group instanceof \PHPGoogleMaps\Overlay\MarkerGroup ) {
			$this->groups[] = $group;
		}
		else {
			$this->groups[] = new \PHPGoogleMaps\Overlay\MarkerGroup( $group );
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
	public function setIcon( $icon, MarkerIcon $shadow = null ) {
		if ( !$icon instanceof MarkerIcon ) {
			$icon = new MarkerIcon( $icon );
		}
		$this->icon = $icon;
		if ( $shadow ) {
			if ( !$shadow instanceof MarkerIcon ) {
				$shadow = new MarkerIcon( $shadow );
			}
			$this->shadow = $shadow;
		}
		return $this;
	}

	public function getIcon() {
		return $this->icon->icon;
	}

	/**
	 * Sets the marker's shadow
	 *
	 * @param MarkerIcon $icon The marker's shadow.
	 * @return Marker
	 */
	public function setShadow( MarkerIcon $shadow ) {
		$this->shadow = $shadow;
	}

	/**
	 * Sets the marker's shape
	 *
	 * @param MarkerIcon $icon The marker's icon.
	 * @return MarkerIcon
	 */
	public function setShape( MarkerShape $shape ) {
		$this->shape = $shape;
		return $this;
	}

	/**
	 * Enable marker geolocation
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
	 * Factory method to create a marker from a lat/lng
	 *
	 * @param LatLng $latlng Position of the marker
	 * @param string $title The title of the marker. This will be the markers tooltip.
	 * @param string $content The infowindow content of the marker.
	 * @return Marker
	 */
	public static function createFromLatLng( \PHPGoogleMaps\Core\LatLng $position, array $options=null ) {
		return new Marker( $position, $options );
	}

	/**
	 * Factory method to create a marker from a location
	 *
	 * @param string $location Location of the marker. This will be geocoded for you.
	 * @param array options Array of marker options
	 * @return Marker
	 */
	public static function createFromLocation( $location, array $options=null ) {
		$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $location );
		if ( $geocode_result instanceof \PHPGoogleMaps\Core\LatLng ) {
			return self::createFromLatLng( $geocode_result, $options );
		}
		return false;
	}

	/**
	 * Factory method to create a marker from the user's location
	 * This uses HTML5's geolocation API
	 *
	 * @param array options Array of marker options
	 * @return Marker
	 */
	public static function createFromUserLocation( $options ){
		$marker = new Marker( null, $options );
		$marker->enableGeolocation();
		return $marker;
	}

}



