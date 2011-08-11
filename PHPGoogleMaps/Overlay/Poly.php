<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Polygon class
 * Adds a polygon to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Polygon
 */

abstract class Poly extends \PHPGoogleMaps\Core\MapObject {

	/**
	 * Paths
	 * The paths that make up teh polygon
	 *
	 * @var array
	 */
	protected $paths = array();
	
	/**
	 * Constructor
	 *
	 * @param array $options Array of options {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#CircleOptions}
	 * @return Polygon
	 */
	public function __construct( $paths, array $options=null ) {
		if ( $options ) {
			unset( $options['map'] );
			$this->options = $options;
		}
		foreach( $paths as $path ) {
			$this->addPath( $path );
		}
	}

	/**
	 * Add a path
	 * Adds a path to the end of the array of paths
	 *
	 * @throws GeocodeException
	 * @param string|LatLng $location Location to add. This can be a location name
	 *                                or a LatLng object.
	 * @return void
	 */
	public function addPath( $location ) {
		if ( $location instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->paths[] = $location->getLatLng();
		}
		else {
			$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $location, true );
			if ( $geocode_result instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$this->paths[] = $geocode_result->getLatLng();
			}
			else {
				throw new \PHPGoogleMaps\Service\GeocodeException( $geocode_result );
			}
		}
	}

	/**
	 * Get polygon paths
	 *
	 * @return array
	 */
	public function getPaths() {
		return $this->paths;
	}

	/**
	 * Get a path
	 *
	 * @param integer $path Path to get
	 * @return LatLng
	 */
	public function getPath( $path ) {
		$path = (int) $path;
		return $this->paths[$path];
	}

}