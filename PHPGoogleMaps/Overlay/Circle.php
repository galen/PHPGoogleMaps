<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Circle class
 * Adds a circle to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 */

class Circle extends \PHPGoogleMaps\Overlay\Shape {

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
	 * @param string|LatLng $center Position of the center of the circle
	 * @param float $radius Radius of the circle in meters
	 * @param array $options Array of optoins {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#CircleOptions}
	 * @return Circle
	 */
	public function __construct( $center, $radius, array $options=null ) {
		if ( $center instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->center = $center->getLatLng();
		}
		else {
			$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $center, true );
			if ( $geocode_result instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$this->center = $geocode_result->getLatLng();
			}
			else {
				throw new \PHPGoogleMaps\Core\GeocodeException( $geocode_result );
			}
		}
		$this->radius = (float) $radius;
		if ( $options ) {
			unset( $options['map'], $options['center'], $options['radius'] );
			$this->options = $options;
		}
	}

	public static function createFromLatLng( $center, $radius, array $options=null ) {
		return new Circle( $center, $radius, $options );
	}

	public static function createFromLocation( $location, $radius, array $options=null ) {
		$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $location );
		if ( $geocode_result instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			return new Circle( $geocode_result->getLatLng(), $radius, $options );
		}
		return false;
	}

}