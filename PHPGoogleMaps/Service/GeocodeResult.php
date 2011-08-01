<?php

namespace PHPGoogleMaps\Service;

class GeocodeResult extends \PHPGoogleMaps\Core\PositionAbstract {

	public $response;
	public $location;

	public function __construct( $location, $geocode_response ) {
		$this->location = $location;
		$this->response = $geocode_response;
	}

	/**
	 * Get lat lng
	 * Returns a LatLng representation of the object
	 * 
	 * @return LatLng
	 */
	public function getLatLng() {
		return new \PHPGoogleMaps\Core\LatLng( $this->response->results[0]->geometry->location->lat, $this->response->results[0]->geometry->location->lng, $this->location );
	}
	public function getLat() {
		return $this->response->results[0]->geometry->location->lat;
	}
	public function getLng() {
		return $this->response->results[0]->geometry->location->lng;
	}
	public function __get( $var ) {
		if ( isset( $this->response->results[0]->$var ) ) {
			return $this->response->results[0]->$var;
		}
		return null;
	}
	
}