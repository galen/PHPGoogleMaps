<?php

namespace PHPGoogleMaps\Service;

class GeocodeResult extends \PHPGoogleMaps\Core\LatLng {

	/**
	 * Formatted address returned by the geocoder service
	 *
	 * @var string
	 */
	public $formatted_address;

	/**
	 * Raw geocode result
	 *
	 * @var StdClass
	 */
	public $raw;

	/**
	 * Viewport of the first result returned by the geocoder service
	 *
	 * @var StdClass
	 */
	public $viewport;

	/**
	 * Bounds of the first result returned by the geocoder service
	 *
	 * @var StdClass
	 */
	public $bounds;

	/**
	 * Was the location retreived from the cache 
	 *
	 * @var boolean
	 */
	private $was_in_cache = false;

	/**
	 * Was the location written to the cache 
	 *
	 * @var boolean
	 */
	private $was_put_in_cache = false;

	/**
	 * Get lat lng
	 * Returns a LatLng representation of the object
	 * 
	 * @return LatLng
	 */
	public function getLatLng() {
		return new \PHPGoogleMaps\Core\LatLng( $this->lat, $this->lng );
	}

	/**
	 * Set or return cache status
	 * If a boolean is passed this function will set the property
	 * Otherwise it will return it
	 *
	 * @return void|boolean
	 */
	public function wasInCache( $bool=null ) {
		if ( $bool ) {
			$this->was_in_cache = (bool) $bool;
		}
		else {
			return $this->was_in_cache;
		}
	}

	/**
	 * Set or return cache write status
	 * If a boolean is passed this function will set the property
	 * Otherwise it will return it
	 *
	 * @return void|boolean
	 */
	public function wasPutInCache( $bool=null ) {
		if ( $bool ) {
			$this->was_put_in_cache = (bool) $bool;
		}
		else {
			return $this->was_put_in_cache;
		}
	}
	
}