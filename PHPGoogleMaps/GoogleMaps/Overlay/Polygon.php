<?php

namespace GoogleMaps\Overlay;

/**
 * Polygon class
 * Adds a polygon to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Polygon
 */

class Polygon extends \GoogleMaps\Core\MapObject {

	/**
	 * Paths
	 * The paths that make up teh polygon
	 *
	 * @var array
	 */
	protected $paths = array();
	
	/**
	 * Constructor
	 *
	 * @param array $options Array of optoins {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#CircleOptions}
	 * @return Polygon
	 */
	public function __construct( $paths, array $options=null ) {
		unset( $options['map'] );
		$this->options = $options;
		$this->paths = $paths;
	}

	/**
	 * Get polygon paths
	 *
	 * @return array
	 */
	public function getPaths() {
		return $this->paths;
	}

	/**
	 * Get a path
	 *
	 * @param integer $path Path to get
	 * @return LatLng
	 */
	public function getPath( $path ) {
		$path = (int) $path;
		return $this->paths[$path];
	}

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
		return new \GoogleMaps\Core\LatLng( $lat_avg, $lng_avg );
	}

}