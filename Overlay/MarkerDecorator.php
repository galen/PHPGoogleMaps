<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Marker decorator class
 * This holds the marker's id and map
 *
 * Maps wrap markers in this decorator to give markers access to the map_id and marker id
 */

class MarkerDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * ID of the marker in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map ID of the map the marker is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Holds the ID of the icon in the map
	 *
	 * @var int
	 */
	protected $_icon_id;

	/**
	 * Holds the ID of the shadow in the map
	 *
	 * @var int
	 */
	protected $_shadow_id;

	/**
	 * Holds the ID of the shape in the map
	 *
	 * @var int
	 */
	protected $_shape_id;

	/**
	 * Constructor
	 * 
	 * @param Marker $marker Marker to decorate
	 * @param int $id ID of the marker in the map
	 * @param string $map Map Id of the map the marker is attached to
	 * @return MarkerDecorator
	 */
	public function __construct( Marker $marker, $id, $map ) {
		parent::__construct( $marker, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the marker
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.markers[%s]', $this->_map, $this->_id );
	}
	
	/**
	 * Get marker opener
	 * Returns the code to open the marker
	 *
	 * @returns string
	 */
	public function getOpener() {
		return sprintf( 'google.maps.event.trigger(map.markers[%s], \'click\');', $this->_id );
	}
}