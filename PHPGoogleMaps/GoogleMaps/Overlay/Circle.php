<?php

namespace GoogleMaps\Overlay;

/**
 * Circle class
 * Adds a circle to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 */

class Circle extends \GoogleMaps\Overlay\Shape {

	/**
	 * Center
	 * The position of the center of the circle
	 *
	 * @var LatLng
	 */
	protected $center;
	
	/** 
	 * Radius
	 * Radius of the circle in meters
	 *
	 * @var float
	 */
	protected $radius;

	/**
	 * Constructor
	 *
	 * @param LatLng $center Position of the center of the circle
	 * @param float $radius Radius of the circle in meters
	 * @param array $options Array of optoins {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#CircleOptions}
	 * @return Circle
	 */
	public function __construct( \GoogleMaps\Core\LatLng $center, $radius, array $options=null ) {
		$this->center = $center;
		$this->radius = (float) $radius;
		unset( $options['map'], $options['center'], $options['radius'] );
		$this->options = $options;
	}

	public static function createFromLatLng( \GoogleMaps\Core\LatLng $center, $radius, array $options=null ) {
		return new Circle( $center, $radius, $options );
	}

	public static function createFromLocation( $location, $radius, array $options=null ) {
		$geocode_result = \GoogleMaps\Service\Geocoder::getLatLng( $location );
		if ( $geocode_result instanceof \GoogleMaps\Core\LatLng ) {
			return new Circle( $geocode_result, $radius, $options );
		}
		return false;
	}

}