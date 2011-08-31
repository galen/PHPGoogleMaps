<?php

namespace PHPGoogleMaps\Service;

use PHPGoogleMaps\Utility\Scraper;

/**
 * Geocoder class for getting lat/lng corrdinates of a location
 *
 * This uses Google's geocoding API
 * @link http://code.google.com/apis/maps/documentation/geocoding/
 */

class Geocoder {

	/**
	 * Geocodes a location
	 * 
	 * This will return a `GeocodeResult` object if the location is successfully geocoded
	 * The object will contain the properties `lat`, `lng`, `formatted_address`, `viewport` `bounds` and `raw`
	 * lat: latitude for the first returned location
	 * lng: longitude for the first returned location
	 * viewport: viewport for the first returned location
	 * bounds: bounds for the first returned location
	 * raw: the entire response
	 * formatted_address: formatted address for the first returned location
	 *
	 * If an error occurred a `GeocodeError` object will be returned with a `error` property
	 * containing the error status returned from google
	 *
	 * @link http://code.google.com/apis/maps/documentation/geocoding/
	 *
	 * @param string $location
	 * @param boolean $simple If true, only the lat/lng will be returned
	 * @return GeocodeResult|GeocodeError
	 */
	public static function geocode( $location ) {
		$response = self::scrapeAPI( $location );
		if ( $response->status != 'OK' ) {
			$error = new GeocodeError( $response->status, $location );
			return $error;
		}
		return new GeocodeResult( $location, $response );
	}

	/**
	 * Scrape the API
	 *
	 * @param string $location Location to geocode
	 * @return GeocodeError|LatLng Returns a GeocodeError on error, LatLng on success.
	 */
	private static function scrapeAPI( $location ) {
		$url = sprintf( "http://maps.google.com/maps/api/geocode/json?address=%s&sensor=false", urlencode( $location ) );
		$response = json_decode( Scraper::scrape( $url ) );
		return $response;
	}

}