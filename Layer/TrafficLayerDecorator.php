<?php

namespace PHPGoogleMaps\Layer;

/**
 * Traffic layer decorator
 *
 * @author Andrew McLagan https://github.com/andrewmclagan 
 * 
 * Decorate a traffic layer after it has been added to a map
 */
 

class TrafficLayerDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * Id of the Traffic layer in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map id the Traffic layer is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Constructor
	 * 
	 * @param TrafficLayer $Traffic Traffic layer to decorate
	 * @param int $id ID of the Traffic layer in the map
	 * @param string $map Map Id of the map the Traffic layer is attached to
	 * @return TrafficLayerDecorator
	 */
	public function __construct( TrafficLayer $Traffic, $id, $map ) {
		parent::__construct( $Traffic, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the Traffic layer
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.traffic_layers[%s]', $this->_map, $this->_id );
	}

}