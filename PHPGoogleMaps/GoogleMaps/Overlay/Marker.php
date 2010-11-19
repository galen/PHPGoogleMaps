<?php

namespace GoogleMaps\Overlay;

use GoogleMaps\Utility;

/**
 * Marker class for addign markers to a map
 * 
 * Markers can be created in 4 different ways
 *
 * Instantiate a new marker
 * $m = new \GoogleMaps\Overlay\Marker( $latlng, $title, $content );
 *
 * Use the static `createFromCoords()` method
 * $m = \GoogleMaps\Overlay\Marker::createFromLatLng( $latlng, $title, $content );
 *
 * Use the static `createFromLocation()` method which will geocode the location for you
 * using Google's geocode API
 * $m = \GoogleMaps\Overlay\Marker::createFromLocation( $location, $title, $content );
 *
 * Use the static `createFromUserLocation()` method which will attempt to geolocate the
 * user's position using HTML5's geolocation API {@link http://dev.w3.org/geo/api/spec-source.html}
 * $m = \GoogleMaps\Overlay\Marker::createFromUserLocation( $title, $content );
 */
 

class Marker extends \GoogleMaps\Core\MapObject {

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
	 * Marker constructor
	 * Initializes the marker options
	 *
	 * @param LatLng $latlng Position of the marker
	 * @param string $title The title of the marker. This will be the markers tooltip.
	 * @param string $content The infowindow content of the marker.
	 * @return Marker
	*/
	public function __construct( \GoogleMaps\Core\LatLng $latlng=null, array $options=null ) {
		$this->position = $latlng;
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
					if ( $option ) {
						$this->enableGeolocation();
					}
					break;
				default:
					$this->$option_name = $option;
			
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
		if ( $group instanceof \GoogleMaps\Overlay\MarkerGroup ) {
			$this->groups[] = $group;
		}
		else {
			$this->groups[] = new \GoogleMaps\Overlay\MarkerGroup( $group );
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
	public function setIcon( MarkerIcon $icon, MarkerIcon $shadow = null ) {
		$this->icon = $icon;
		if ( $shadow ) {
			$this->shadow = $shadow;
		}
		return $this;
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
	 * Factory method to create a marker from a lat/lng
	 *
	 * @param LatLng $latlng Position of the marker
	 * @param string $title The title of the marker. This will be the markers tooltip.
	 * @param string $content The infowindow content of the marker.
	 * @return Marker
	 */
	public static function createFromLatLng( \GoogleMaps\Core\LatLng $position, array $options=null ) {
		return new Marker( $position, $options );
	}

	/**
	 * Factory method to create a marker from a location
	 *
	 * @param string $location Location of the marker. This will be geocoded for you.
	 * @param string $title Title of the marker. This will be the markers tooltip.
	 * @param string $content The infowindow content of the marker.
	 * @return Marker
	 */
	public static function createFromLocation( $location, array $options=null ) {
		$geocode_result = \GoogleMaps\Service\Geocoder::getLatLng( $location );
		if ( $geocode_result instanceof \GoogleMaps\Core\LatLng ) {
			return self::createFromLatLng( $geocode_result, $options );
		}
		return false;
	}

	/**
	 * Factory method to create a marker from the user's location
	 * This uses HTML5's geolocation API
	 *
	 * @param string $title The title of the marker. This will be the markers tooltip.
	 * @param string $content The infowindow content of the marker.
	 * @return Marker
	 */
	public static function createFromUserLocation( $options ){
		return self::createFromLatLng( null, $options )->enableGeolocation();
	}

}



