<?php

namespace PHPGoogleMaps\Service;

/**
 * Caching Geocoder class for getting cached geocodes
 *
 * This uses Google's geocoding API
 * @link http://code.google.com/apis/maps/documentation/geocoding/
 */

class CachingGeocoder {

	/**
	 * Geocode cache object
	 *
	 * @var GeocodeCache
	 */
	private $geocode_cache;

	/**
	 * Constructor
	 *
	 * @param GeocodeCache $gc
	 *
	 */
	public function __construct( \PHPGoogleMaps\Service\GeocodeCache $gc ) {
		$this->geocode_cache = $gc;
	}

	/**
	 * Write to cache
	 *
	 * @param string $location Location to cache
	 * @param float $lat Latitude of location
	 * @param float $lng Longitude of location
	 *
	 * @return boolean
	 */
	private function writeCache( $location, $lat, $lng ) {
		return $this->geocode_cache->writeCache( strtolower( $location ), $lat, $lng );
	}

	/**
	 * Get from cache
	 *
	 * @param string $location Location to get from cache
	 * @return false|LatLng
	 */
	private function getCache( $location ) {
		return $this->geocode_cache->getCache( strtolower( $location ) );
	}

	/**
	 * Geocodes a location
	 * 
	 * This will return a `LatLng` object if the location is successfully geocoded
	 * The object will contain a `latitude`, a `longitude`
	 *
	 * If an error occurred a `GeocodeError` object will be returned with a `status` property
	 * containing the error status returned from google
	 *
	 * @link http://code.google.com/apis/maps/documentation/geocoding/
	 *
	 * @param string $location
	 * @return LatLng|GeocodeError
	 */
	public function geocode( $location ) {
		if ( $get_cache = $this->getCache( $location ) ) {
			return $get_cache;
		}
		else {
			$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $location );
			if ( $geocode_result instanceof \PHPGoogleMaps\Service\GeocodeResult ) {
				if ( $write_cache = $this->writeCache( $location, $geocode_result->getLat(), $geocode_result->getLng() ) ) {
					$geocode_result = new \PHPGoogleMaps\Service\CachedGeocodeResult( $geocode_result->getLatLng(), false, true );
				}
			}
			return $geocode_result;
		}
	}

}