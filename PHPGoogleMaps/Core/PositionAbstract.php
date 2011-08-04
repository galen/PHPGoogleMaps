<?php

namespace PHPGoogleMaps\Core;

/**
 * AbstractPosition
 *
 * Base class for all objects that have position data
 * LatLng, GeocodeResult
 *
 */

Abstract class PositionAbstract {
	
	/**
	 * Get the LatLng object
	 *
	 * @return LatLng
	 */
	abstract public function getLatLng();
	abstract public function getLat();
	abstract public function getLng();
	/**
	 * Get distance from another latlng
	 *
	 * @param PositionAbstract $latlng LatLng object to get distance from.
	 * @param float $adjustment Adjust the distance to take turns into account.
	 *                          1.125 seems to be the most accurate.
	 * @param string $units Units to return. Default (m) is miles.
	 *                      n = nautical miles, k = kilometers,
	 *                      f = feet, i = inches.
	 * @return float Distance in the specified units
	 */
	public function getDistanceFrom( PositionAbstract $latlng, $adjustment=1.125, $units='m' ) {
		$miles = $adjustment * 3959 * acos( cos( deg2rad( $this->getLat() ) ) * cos( deg2rad( $latlng->getLat() ) ) * cos( deg2rad( $this->getLng() ) - deg2rad( $latlng->getLng() ) ) + sin( deg2rad($this->getLat() ) ) * sin( deg2rad( $latlng->getLat() ) ) );
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