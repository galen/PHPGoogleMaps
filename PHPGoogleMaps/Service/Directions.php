<?php

namespace PHPGoogleMaps\Service;

/**
 * Directions class
 *
 * Example:
 * This enabled a draggable route and adds a waypoint
 * $request = array( 'waypoints' => array( array( 'location' => \PHPGoogleMaps\Service\Geocoder::geocode( 'Phoenix, AZ' ) ) ) );
 * $renderer = array( 'draggable' => true );
 * $dir = new \PHPGoogleMaps\Service\DrivingDirections( 'New York, NY', 'San Jose, CA', $renderer, $request );
 */

abstract class Directions extends \PHPGoogleMaps\Core\MapObject {

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
			unset( $request_options['waypoints'] );
			$this->request_options = $request_options;
		}

		$this->request_options['travelMode'] = $this->travel_mode;

		if ( $origin instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->request_options['origin'] = $origin->getLatLng();
		}
		else {
			if ( ( $geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $origin ) ) instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$this->request_options['origin'] = $geocode_result->getLatLng();
			}
			else {
				throw new \PHPGoogleMaps\Service\GeocodeException( $geocode_result );
			}
		}

		if ( $destination instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->request_options['destination'] = $destination->getLatLng();
		}
		else {
			if ( ( $geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $destination ) ) instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$this->request_options['destination'] = $geocode_result;
			}
			else {
				throw new \PHPGoogleMaps\Service\GeocodeException( $geocode_result );
			}
		}

	}
	
	/**
	 * Add a waypoint
	 *
	 * @param string|PositionAbstract $waypoint The waypoint
	 * @param boolean $stopover
	 */
	public function addWaypoint( $waypoint, $stopover=true ) {
		if ( $waypoint instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->request_options['waypoints'][] = array( 'location' => $waypoint->getLatLng()  );
		}
		else {
			if ( ( $geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $waypoint, true ) ) instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$this->request_options['waypoints'][] =  array( 'location' => $geocode_result->getLatLng() );
			}
			else {
				throw new \PHPGoogleMaps\Service\GeocodeException( $geocode_result );
			}
		}
	}

}