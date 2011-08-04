<?php

namespace PHPGoogleMaps\Core;

/**
 * LatLng class
 * Base class used for storing lat/lngs
 */

class LatLng extends PositionAbstract {

	/**
	 * Latitude
	 *
	 * @var float
	 */
	public $lat;
	
	/**
	 * Longitude
	 *
	 * @var float
	 */
	public $lng;

	/**
	 * LatLng location
	 *
	 * @var string
	 */
	public $location;

	/**
	 * Constructor
	 *
	 * @param float $lat Latitude
	 * @param float $lng Longitude
	 * @return LatLng
	 */
	public function __construct( $lat, $lng, $location=null ) {
		$this->lat = $lat;
		$this->lng = $lng;
		$this->location = $location;
	}

	public function getLatLng() {
		return $this;
	}
	public function getLat() {
		return $this->lat;
	}
	public function getLng() {
		return $this->lng;
	}

	/**
	 * Returns a string in the format lat,lng
	 *
	 * @return string
	 */
	public function __toString() {
		return sprintf( '%s,%s', $this->lat, $this->lng );
	}
}