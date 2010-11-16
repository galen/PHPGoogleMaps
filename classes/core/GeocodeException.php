<?php

namespace googlemaps\core;

/**
 * Geocode exception
 */
class GeocodeException extends \Exception {

	/**
	 * Geocode error
	 * @link http://code.google.com/apis/maps/documentation/geocoding/#StatusCodes
	 *
	 * @var string
	 */
	public $error;
	
	/**
	 * The invalid location
	 *
	 * @var string
	 */
	public $invalid_location;

}