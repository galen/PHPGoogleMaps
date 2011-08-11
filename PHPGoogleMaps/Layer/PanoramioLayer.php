<?php

namespace PHPGoogleMaps\Layer;

/**
 * Panoramio Layer
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/overlays.html#PanoramioLibrary
 */

class PanoramioLayer extends \PHPGoogleMaps\Core\MapObject  {

	/**
	 * Constructor
	 * 
	 * @param array $options Array of optoins
	 * @return PanoramioLayer
	 */
	public function __construct( array $options=null ) {
		if ( $options ) {
			unset( $options['map'] );
			$this->options = $options;
		}
	}

	/**
	 * Set tag
	 *
	 * @param string $tag Tag
	 * @return void
	 */
	public function setTag( $tag ) {
		$this->options['tag'] = $tag;
	}

	/**
	 * Set User ID
	 *
	 * @param integer $user_id User ID
	 * @return void
	 */
	public function setUserID( $user_id ) {
		$this->options['user_id'] = (int)$user_id;
	}

}