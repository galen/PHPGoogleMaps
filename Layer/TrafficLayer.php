<?php

namespace PHPGoogleMaps\Layer;

/**
 * Traffic Layer
 *
 * @author Andrew McLagan https://github.com/andrewmclagan
 *
 * @link https://developers.google.com/maps/documentation/javascript/reference#TrafficLayer
 */

class TrafficLayer extends \PHPGoogleMaps\Core\MapObject  {

	/**
	 * Constructor
	 * 
	 * @param array $options Array of optoins
	 * @return TrafficLayer
	 */
	public function __construct( array $options=null ) {
		if ( $options ) {
			unset( $options['map'] );
			$this->options = $options;
		}
	}
}