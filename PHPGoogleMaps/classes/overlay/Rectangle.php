<?php

namespace googlemaps\overlay;

/**
 * Rectangle class
 * Adds a rectangle to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Rectangle
 */

class Rectangle extends \googlemaps\overlay\Shape {

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
	 * @param LatLng $southwest Southwest point of the rectangle
	 * @param LatLng $northeast Northeast point of the rectangle
	 * @param array $options Array of rectangle options {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#RectangleOptions}
	 * @return Rectangle
	 */
	public function __construct( \googlemaps\core\LatLng $southwest, \googlemaps\core\LatLng $northeast, array $options=null ) {
		$this->southwest = $southwest;
		$this->northeast = $northeast;
		unset( $options['map'], $options['bounds'] );
		$this->options = $options;
	}

}