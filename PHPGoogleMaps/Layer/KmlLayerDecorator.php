<?php

namespace PHPGoogleMaps\Layer;

/**
 * KML layer decorator
 */
 

class KmlLayerDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * Id of the KML layer in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map id the KML layer is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Constructor
	 * 
	 * @param KmlLayer $kml KML layer to decorate
	 * @param int $id ID of the KML layer in the map
	 * @param string $map Map Id of the map the KML layer is attached to
	 * @return KmlLayerDecorator
	 */
	public function __construct( KmlLayer $kml, $id, $map ) {
		parent::__construct( $kml, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the KML layer
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.kml_layers[%s]', $this->_map, $this->_id );
	}

}