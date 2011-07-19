<?php

namespace PHPGoogleMaps\Service;

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

}