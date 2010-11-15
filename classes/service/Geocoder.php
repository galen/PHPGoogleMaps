<?php

namespace googlemaps\service;

use googlemaps\utility\Scraper;

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
	 * The object will contain a `latitude`, a `longitude`, and optionally a viewport and or bounds
	 *
	 * If an error occurred a `GeocodeError` object will be returned with a `status` property
	 * containing the error status returned from google
	 *
	 * @link http://code.google.com/apis/maps/documentation/geocoding/
	 *
	 * @param string $location
	 * @param boolean $return_viewport {@link http://code.google.com/apis/maps/documentation/geocoding/#Results}
	 * @param boolean $return_bounds {@link http://code.google.com/apis/maps/documentation/geocoding/#Results}
	 * @return GeocodeResult|GeocodeError
	 */
	public static function geocode( $location, $return_viewport=false, $return_bounds=false ) {

		$url = sprintf( "http://maps.google.com/maps/api/geocode/json?address=%s&sensor=false", urlencode( $location ) );

		$gc = json_decode( Scraper::scrape( $url ) );

		if ( $gc->status != 'OK' ) {
			$e = new GeocodeError;
			$e->error = $gc->status;
			return $e;
		}

		$geocoded_location = new GeocodeResult;
		$geocoded_location->lat = $gc->results[0]->geometry->location->lat;
		$geocoded_location->lng = $gc->results[0]->geometry->location->lng;

		if ( $return_viewport ) {
			$geocoded_location->viewport = new stdClass;
			$geocoded_location->viewport->southwest = new stdClass;
			$geocoded_location->viewport->southwest->lat = $gc->results[0]->geometry->viewport->southwest->lat;
			$geocoded_location->viewport->southwest->lng = $gc->results[0]->geometry->viewport->southwest->lng;
			$geocoded_location->viewport->northeast = new stdClass;
			$geocoded_location->viewport->northeast->lat = $gc->results[0]->geometry->viewport->northeast->lat;
			$geocoded_location->viewport->northeast->lng = $gc->results[0]->geometry->viewport->northeast->lng;
		}
		
		if ( $return_bounds ) {
			$geocoded_location->bounds = new stdClass;
			$geocoded_location->bounds->southwest = new stdClass;
			$geocoded_location->bounds->southwest->lat = $gc->results[0]->geometry->bounds->southwest->lat;
			$geocoded_location->bounds->southwest->lng = $gc->results[0]->geometry->bounds->southwest->lng;
			$geocoded_location->bounds->northeast = new stdClass;
			$geocoded_location->bounds->northeast->lat = $gc->results[0]->geometry->bounds->northeast->lat;
			$geocoded_location->bounds->northeast->lng = $gc->results[0]->geometry->bounds->northeast->lng;
		}

		return $geocoded_location;
		
	}

}

class GeocodeResult {}
class GeocodeError {}

