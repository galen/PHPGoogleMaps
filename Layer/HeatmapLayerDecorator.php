<?php

namespace PHPGoogleMaps\Layer;

/**
 * Panoramio layer decorator
 * 
 * Decorate a panoramio layer after it has been added to a map
 */
 

class HeatmapLayerDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * Id of the HeatmapLayer layer in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map id the HeatmapLayer is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Constructor
	 * 
	 * @param HeatmapLayer $heatmapLayer
	 * @param int $id ID of the HeatmapLayer layer in the map
	 * @param string $map Map Id of the map the HeatmapLayer is attached to
	 */
	public function __construct( HeatmapLayer $heatmapLayer, $id, $map ) {
		parent::__construct( $heatmapLayer, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the Heatmap layer
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.heatmap_layers[%s]', $this->_map, $this->_id );
	}

}