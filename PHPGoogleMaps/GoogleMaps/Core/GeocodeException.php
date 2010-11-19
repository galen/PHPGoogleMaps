<?php

namespace GoogleMaps\Core;

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
	public $location;

	public function __construct( \GoogleMaps\Service\GeocodeError $geocode_error ) {
		$this->error = $geocode_error->error;
		$this->location = $geocode_error->location;
		parent::__construct();
	}

}