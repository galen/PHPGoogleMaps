<?php

namespace PHPGoogleMaps\Layer;

/**
 * KML Layer class
 * Allows you to add a KML layer to a map
 * 
 * @link http://code.google.com/apis/maps/documentation/javascript/overlays.html#KMLLayers
 */

class KmlLayer extends \PHPGoogleMaps\Core\MapObject  {

	/**
	 * URL of the KML layer
	 *
	 * @var string
	 */
	protected $url;
	
	/**
	 * Constructor
	 *
	 * @param string $url URL of the KML layer
	 * @param array $options KML layer options
	 * @return KMLLayer
	 */
	public function __construct( $url, array $options=null ) {
		if ( $options ) {
			unset( $options['map'] );
			$this->options = $options;
		}
		$this->url = $url;
	}

}