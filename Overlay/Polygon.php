<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Polygon class
 * Adds a polygon to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Polygon
 */

class Polygon extends Poly {

	/**
	 * Get polygon center
	 *
	 * @return LatLng
	 */
	public function getCenter() {
		$lat_sum = 0;
		$lng_sum = 0;
		foreach( $this->paths as $path ) {
			$lat_sum += $path->lat;
			$lng_sum += $path->lng;
		}
		$lat_avg = $lat_sum / count( $this->paths );
		$lng_avg = $lng_sum / count( $this->paths );
		return new \PHPGoogleMaps\Core\LatLng( $lat_avg, $lng_avg );
	}

}