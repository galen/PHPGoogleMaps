<?php

namespace PHPGoogleMaps\Service;

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
	
	/**
	* Constructor
	*
	* @param GeocodeError $geocode_error The GeocodeError object returned
	* @returns GeocodeException
	*/
	public function __construct( \PHPGoogleMaps\Service\GeocodeError $geocode_error ) {
		$this->error = $geocode_error->error;
		$this->location = $geocode_error->location;
		parent::__construct();
	}

}