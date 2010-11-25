<?php

namespace GoogleMaps\Overlay;

/**
 * Polygon decorator
 */

class PolygonDecorator extends \GoogleMaps\Core\MapObjectDecorator {

	/**
	 * ID of the polygon in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map ID of the map the polygon is attached to
	 *
	 * @var string
	 */
	protected $_map;
	 
	/**
	 * Constructor
	 *
	 * @param Polygon $polygon The polygon to decorate
	 * @param int integer $id ID of the polygon in the map
	 * @param string $map Map ID of the map the polygon is attached to
	 */	
	public function __construct( Polygon $polygon, $id, $map ) {
		parent::__construct( $polygon, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the polygon
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.polygons[%s]', $this->_map, $this->_id );
	}

}