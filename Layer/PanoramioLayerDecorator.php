<?php

namespace PHPGoogleMaps\Layer;

/**
 * Panoramio layer decorator
 * 
 * Decorate a panoramio layer after it has been added to a map
 */
 

class PanoramioLayerDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * Id of the Panoramio layer in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map id the Panoramio layer is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Constructor
	 * 
	 * @param PanoramioLayer $Panoramio Panoramio layer to decorate
	 * @param int $id ID of the Panoramio layer in the map
	 * @param string $map Map Id of the map the Panoramio layer is attached to
	 * @return PanoramioLayerDecorator
	 */
	public function __construct( PanoramioLayer $panoramio, $id, $map ) {
		parent::__construct( $panoramio, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the Panoramio layer
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.panoramio_layers[%s]', $this->_map, $this->_id );
	}

}