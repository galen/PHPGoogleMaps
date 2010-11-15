<?php

namespace googlemaps\overlay;

/**
 * Circle class
 * Adds a circle to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 */

class Circle extends \googlemaps\overlay\Shape {

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
	public function __construct( \googlemaps\core\LatLng $center, $radius, array $options=null ) {
		$this->center = $center;
		$this->radius = (float) $radius;
		unset( $options['map'], $options['center'], $options['radius'] );
		$this->options = $options;
	}

}