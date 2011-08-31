<?php

namespace PHPGoogleMaps\Service;

/**
 * GeocodeError class
 * This class is returned by Geocoder if an error occurs
 */

class GeocodeError {

	/**
	 * Error returned by google
	 * @link http://code.google.com/apis/maps/documentation/geocoding/#StatusCodes
	 *
	 * @var string
	 */
	public $error;

	/**
	 * Location that failed to geocode
	 *
	 * @var string
	 */
	public $location;

	/**
	 * Constructor
	 *
	 * @param string $error Error return by google
	 * @param string $location Location that failed to geocode
	 * @return GeocodeError
	 */
	function __construct( $error, $location ) {
		$this->error = $error;
		$this->location = $location;
	}

}