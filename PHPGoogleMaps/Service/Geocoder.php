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
	 * @return GeocodeResult|GeocodeError
	 */
	public function geocode( $location, $simple=false ) {
		$response = self::scrapeAPI( $location );
		if ( $response instanceof GeocodeError ) {
			return $response;
		}
		
		if ( $simple ) {
			return new \PHPGoogleMaps\Core\LatLng( $response->results[0]->geometry->location->lat, $response->results[0]->geometry->location->lng );
		}
		
		$geocoded_location = new GeocodeResult( $response->results[0]->geometry->location->lat, $response->results[0]->geometry->location->lng );
		$geocoded_location->formatted_address = $response->results[0]->formatted_address;
		$geocoded_location->raw = $response->results;
		$geocoded_location->viewport = new \stdClass;
		$geocoded_location->viewport->southwest = new \PHPGoogleMaps\Core\LatLng( $response->results[0]->geometry->viewport->southwest->lat, $response->results[0]->geometry->viewport->southwest->lng );
		$geocoded_location->viewport->northeast = new \PHPGoogleMaps\Core\LatLng( $response->results[0]->geometry->viewport->northeast->lat, $response->results[0]->geometry->viewport->northeast->lng );

		$geocoded_location->bounds = new \stdClass;
		$geocoded_location->bounds->southwest = new \PHPGoogleMaps\Core\LatLng( $response->results[0]->geometry->bounds->southwest->lat, $response->results[0]->geometry->bounds->southwest->lng );
		$geocoded_location->bounds->northeast = new \PHPGoogleMaps\Core\LatLng( $response->results[0]->geometry->bounds->northeast->lat, $response->results[0]->geometry->bounds->northeast->lng );

		return $geocoded_location;
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
		if ( $response->status != 'OK' ) {
			$e = new GeocodeError;
			$e->error = $response->status;
			$e->location = $location;
			return $e;
		}
		return $response;
	}

}