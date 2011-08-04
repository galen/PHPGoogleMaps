<?php

namespace PHPGoogleMaps\Service;

/**
 * Geocode result
 *
 * Returned by a Geocoder
 */

class GeocodeResult extends \PHPGoogleMaps\Core\PositionAbstract {

	/**
	 * Raw geocode response
	 *
	 * @var string
	 */
	public $response;

	/**
	 * Geocoded location
	 *
	 * @var string
	 */
	public $location;

	/**
	 * Constructor
	 *
	 * @param string $location Location that was geocoded
	 * @param string $geocode_response Raw geocode response
	 * @return GeocodeCachedResult
	 */
	public function __construct( $location, $geocode_response ) {
		$this->location = $location;
		$this->response = $geocode_response;
	}

	/**
	 * Get the LatLng object
	 * Returns a LatLng representation of the object
	 * 
	 * @return LatLng
	 */
	public function getLatLng() {
		return new \PHPGoogleMaps\Core\LatLng( $this->response->results[0]->geometry->location->lat, $this->response->results[0]->geometry->location->lng, $this->location );
	}

	/**
	 * Get lat
	 *
	 * @return float
	 */
	public function getLat() {
		return $this->response->results[0]->geometry->location->lat;
	}

	/**
	 * Get lng
	 *
	 * @return float
	 */
	public function getLng() {
		return $this->response->results[0]->geometry->location->lng;
	}
	
	/**
	 * Get a variable from the first geocode result
	 *
	 * @param string $var Varibale to get
	 * @return mixed
	 */
	public function __get( $var ) {
		if ( isset( $this->response->results[0]->$var ) ) {
			return $this->response->results[0]->$var;
		}
		return null;
	}
	
}