<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Rectangle class
 * Adds a rectangle to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Rectangle
 */

class Rectangle extends \PHPGoogleMaps\Overlay\Shape {

	/**
	 * Southwest point of the rectangle
	 *
	 * @var LatLng
	 */
	protected $southwest;

	/**
	 * Northeast point of the rectangle
	 *
	 * @var LatLng
	 */
	protected $northeast;

	/**
	 * Constructor
	 *
	 * @param string|PositionAbstract $southwest Southwest point of the rectangle
	 * @param string|PositionAbstract $northeast Northeast point of the rectangle
	 * @param array $options Array of rectangle options {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#RectangleOptions}
	 * @return Rectangle
	 */
	public function __construct( $southwest, $northeast, array $options=null ) {

		if ( $southwest instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->southwest = $southwest->getLatLng();
		}
		else {
			$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $southwest, true );
			if ( $geocode_result instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$this->southwest = $geocode_result;
			}
			else {
				throw new \PHPGoogleMaps\Core\GeocodeException( $geocode_result );
			}
		}
		if ( $northeast instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->northeast = $northeast->getLatLng();
		}
		else {
			$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $northeast, true );
			if ( $geocode_result instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$this->northeast = $geocode_result;
			}
			else {
				throw new \PHPGoogleMaps\Service\GeocodeException( $geocode_result );
			}
		}

		if ( $options ) {
			unset( $options['map'], $options['bounds'] );
			$this->options = $options;
		}
	}

}