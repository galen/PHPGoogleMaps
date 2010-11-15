<?php

namespace googlemaps\layer;

/**
 * KML layer decorator
 * 
 */
 

abstract class KmlLayerDecorator extends \googlemaps\core\MapObjectDecorator {

	/**
	 * Id of the KML layer in the map
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 * Map id the KML layer is attached to
	 *
	 * @var string
	 */
	protected $map;

	/**
	 * Constructor
	 * 
	 * @param KmlLayer $kml KML layer to decorate
	 * @param int $id ID of the KML layer in the map
	 * @param string $map Map Id of the map the KML layer is attached to
	 * @return KmlLayerDecorator
	 */
	public function __construct( KmlLayer $kml, $id, $map ) {
		parent::__construct( $kml, array( 'id' => $id, 'map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the KML layer
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.kml_layers[%s]', $this->map, $this->id );
	}

}