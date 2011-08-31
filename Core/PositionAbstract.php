<?php

namespace PHPGoogleMaps\Core;

/**
 * AbstractPosition
 *
 * Base class for all objects that have position data
 * LatLng, GeocodeResult, CachedGeocodeResult
 *
 */

Abstract class PositionAbstract {
	
	/**
	 * Get the LatLng object
	 *
	 * @return LatLng
	 */
	abstract public function getLatLng();

	/**
	 * Get the lat
	 *
	 * @return float
	 */
	abstract public function getLat();

	/**
	 * Get the lng
	 *
	 * @return float
	 */
	abstract public function getLng();

	/**
	 * Get distance from another position
	 *
	 * @param PositionAbstract $position Position to get distance from.
	 *
	 * @param string $units Units to return. Default (m) is miles.
	 * n = nautical miles, k = kilometers,
	 * f = feet, i = inches.
	 *
	 * @param float $adjustment Adjust the distance to take turns into account.
	 * 1.125 seems to be the most accurate.
	 *
	 * @return float Distance in the specified units
	 */
	public function getDistanceFrom( PositionAbstract $position, $units='m', $adjustment=1.125 ) {
		$miles = $adjustment * 3959 * acos( cos( deg2rad( $this->getLat() ) ) * cos( deg2rad( $position->getLat() ) ) * cos( deg2rad( $this->getLng() ) - deg2rad( $position->getLng() ) ) + sin( deg2rad($this->getLat() ) ) * sin( deg2rad( $position->getLat() ) ) );
		switch( strtolower( $units ) ) {
			case 'k': // kilometers
				return $miles * 1.609344;
				break;
			case 'n': // nautical mile
				return $miles * 0.868976242;
				break;
			case 'f': // feet
				return $miles * 5280;
				break;            
			case 'i': // inches
				return $miles * 63360;
				break;            
			case 'm':
			default:
				return $miles;
				break;
		}
	}

}