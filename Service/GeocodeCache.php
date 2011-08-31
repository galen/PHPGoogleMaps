<?php

namespace PHPGoogleMaps\Service;

/**
 * Geocode cache interface
 * All geocode cache classes must implement this interface 
 */

interface GeocodeCache {

	/**
	 * Get cache
	 *
	 * @return false|CachedGeocodeResult
	 */
	public function getCache( $location );

	/**
	 * Write to cache
	 * 
	 * @return boolean
	 */
	public function writeCache( $location, $lat, $lng );

}