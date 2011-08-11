<?php

namespace PHPGoogleMaps\Overlay;

/**
 * GroundOverlay class
 * Adds a ground overlay to the map
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlay
 */

class GroundOverlay extends \PHPGoogleMaps\Core\MapObject {

	/** 
	 * URL
	 * URL of the image
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * Southwest point of the ground overlay
	 *
	 * @var LatLng
	 */
	protected $southwest;

	/**
	 * Northeast point of the ground overlay
	 *
	 * @var LatLng
	 */
	protected $northeast;

	/**
	 * Constructor
	 *
	 * @param PositionAbstract $southwest Southwest point of the ground overlay
	 * @param PositionAbstract $northeast Northeast point of the ground overlay
	 * @param array $options Array of ground overlay options {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlayOptions}
	 * @return Rectangle
	 */
	public function __construct( $url, \PHPGoogleMaps\Core\PositionAbstract $southwest, \PHPGoogleMaps\Core\PositionAbstract $northeast, array $options=null ) {
		$this->url = $url;
		$this->southwest = $southwest;
		$this->northeast = $northeast;
		if ( $options ) {
			unset( $options['map'] );
			$this->options = $options;
		}
	}

}