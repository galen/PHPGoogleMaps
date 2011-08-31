<?php

namespace PHPGoogleMaps\Service;

/**
 * Cached geocode result
 *
 * This is returned by CachingGeocoder
 */

class CachedGeocodeResult extends \PHPGoogleMaps\Core\PositionAbstract {

	/**
	 * LatLng of the location
	 *
	 * @var LatLng
	 */
	protected $latLng;
	
	/**
	 * Was retrieved from cache flag
	 *
	 * @var boolean
	 */
	protected $was_in_cache;

	/**
	 * Was inserted into cache flag
	 *
	 * @var boolean
	 */
	protected $was_put_in_cache;

	/**
	 * Location that was geocoded
	 *
	 * @var string
	 */
	public $location;

	/**
	 * Constructor
	 *
	 * @param string $location Location that was geocoded
	 * @param string $geocode_response Raw geocode response
	 * @param boolean $was_in_cache True if the location was retrieved from the cache
	 * @param boolean $was_put_in_cache True if the location was added to the cache
	 * @return CachedGeocodeResult
	 */
	public function __construct( \PHPGoogleMaps\Core\LatLng $latlng, $was_in_cache, $was_put_in_cache=null ) {
		$this->was_in_cache = (bool)$was_in_cache;
		if ( isset( $was_put_in_cache ) ) {
			$this->was_put_in_cache = (bool)$was_put_in_cache;
		}
		$this->latLng = $latlng;
		$this->location = $latlng->location;
	}

	/**
	 * Get cached flag
	 * Returns whether the location's geocode was retrieved from the cache
	 *
	 * @return boolean
	 */
	public function wasInCache() {
		return $this->was_in_cache;
	}

	/**
	 * Get cached flag
	 * Returns whether the location's geocode was written to the cash
	 *
	 * @return boolean
	 */
	public function wasPutInCache() {
		return $this->was_put_in_cache;
	}

	/**
	 * Get LatLng object
	 *
	 * @return LatLng
	 */
	public function getLatLng() {
		return $this->latLng;
	}

	/**
	 * Get lat
	 *
	 * @return float
	 */
	public function getLat() {
		return $this->latLng->getLat();
	}

	/**
	 * Get lng
	 *
	 * @return float
	 */
	public function getLng() {
		return $this->latLng->getLng();
	}
}