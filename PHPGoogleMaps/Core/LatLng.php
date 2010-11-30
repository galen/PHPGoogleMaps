<?php

namespace PHPGoogleMaps\Core;

/**
 * Lat Lng class
 * Base class used for storing lat/lngs
 */

class LatLng {

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
	 * Constructor
	 *
	 * @param float $lat Latitude
	 * @param float $lng Longitude
	 * @return LatLng
	 */
	public function __construct( $lat, $lng ) {
		$this->lat = $lat;
		$this->lng = $lng;
	}

}