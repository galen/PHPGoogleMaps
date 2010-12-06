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

	/**
	 * Get distance from another latlng
	 *
	 * @param LatLng $latlng LatLng object to get distance from.
	 * @param float $adjustment Adjust the distance to take turns into account.
	 *                          1.125 seems to be the most accurate.
	 * @param string $units Units to return. Default (m) is miles.
	 *                      n = nautical miles, k = kilometers,
	 *                      f = feet, i = inches.
	 * @return float Distance in the specified units
	 */
	public function getDistanceFrom( LatLng $latlng, $adjustment=1.125, $units='m' ) {
		$miles = $adjustment * 3959 * acos( cos( deg2rad( $this->lat ) ) * cos( deg2rad( $latlng->lat ) ) * cos( deg2rad( $this->lng ) - deg2rad( $latlng->lng ) ) + sin( deg2rad($this->lat ) ) * sin( deg2rad( $latlng->lat ) ) );
		switch( strtolower( $units ) ) {
			case 'k':
				return $miles * 1.609344;
				break;
			case 'n':
				return $miles * 0.868976242;
				break;
			case 'f':
				return $miles * 5280;
				break;            
			case 'i':
				return $miles * 63360;
				break;            
			case 'm':
			default:
				return $miles;
				break;
		}
	}
}