<?php

namespace GoogleMaps\Service;

/**
 * Directions class
 *
 * Example:
 * This enabled a draggable route and adds a waypoint
 * $request = array( 'waypoints' => array( array( 'location' => \GoogleMaps\Service\Geocoder::geocode( 'Phoenix, AZ' ) ) ) );
 * $renderer = array( 'draggable' => true );
 * $dir = new \GoogleMaps\Service\DrivingDirections( 'New York, NY', 'San Jose, CA', $renderer, $request );
 */

abstract class Directions extends \GoogleMaps\Core\MapObject {

	/**
	 * Directions request options
	 * Array of directions request options
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRequest
	 *
	 * @var array
	 */
	protected $request_options = array();
	
	/**
	 * Directions renderer options
	 * Array of directions renderer options
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRendererOptions
	 *
	 * @var array
	 */
	protected $renderer_options = array();

	/**
	 * Constructor
	 *
	 * @throws GeocodeException 
	 * @param string|LatLng $origin Origin. Can be a LatLng object or a string location e.g. San Jose, CA
	 * @param string|LatLng $destination Destination. Can be a LatLng object or a string location e.g. San Jose, CA
	 * @param array $renderer_options Array of renderer options corresponding to one of these:
	 *                                {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRendererOptions}
	 * @param array $request_options Array of request options corresponding to one of these:
	 *                               {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRendererOptions}
	 * @return Directions
	 */
	public function __construct( $origin, $destination, array $renderer_options=null, array $request_options=null ) {

		unset( $renderer_options['directions'], $renderer_options['map'] );
		unset( $request_options['origin'], $request_options['destination'], $request_options['travelMode'] );

		if ( $renderer_options ) {
			$this->renderer_options = $renderer_options ;
		}
		if ( $request_options ) {
			$this->request_options = $request_options;
		}

		$this->request_options['travelMode'] = $this->travel_mode;

		if ( $origin instanceof \GoogleMaps\Core\LatLng ) {
			$this->request_options['origin'] = $origin;
		}
		else {
			if ( ( $geo = \GoogleMaps\Service\Geocoder::getLatLng( $origin ) ) instanceof \GoogleMaps\Core\LatLng ) {
				$this->request_options['origin'] = $geo;
			}
			else {
				throw new \GoogleMaps\Core\GeocodeException( $geo );
			}
		}

		if ( $destination instanceof \GoogleMaps\Core\LatLng ) {
			$this->request_options['destination'] = $destination;
		}
		else {
			if ( ( $geo = \GoogleMaps\Service\Geocoder::getLatLng( $destination ) ) instanceof \GoogleMaps\Core\LatLng ) {
				$this->request_options['destination'] = $geo;
			}
			else {
				$exc = new \GoogleMaps\Core\GeocodeException( sprintf( 'Unable to geocode "%s"', $destination ) );
				$exc->error = $geo->error;
				if ( $geo->error == 'ZERO_RESULTS' ) {
					$exc->invalid_location = $destination;
				}
				throw $exc;
			}
		}

	} 

}