<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Shape decorator
 */

class ShapeDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * ID of the shape in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map ID of the map the shape is attached to
	 *
	 * @var string
	 */
	protected $_map;
	 
	/**
	 * Constructor
	 *
	 * @param Shape $shape The shape to decorate
	 * @param int integer $id ID of the shape in the map
	 * @param string $map Map ID of the map the shape is attached to
	 */	
	public function __construct( Shape $shape, $id, $map ) {
		parent::__construct( $shape, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the shape
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.shapes[%s]', $this->_map, $this->_id );
	}

}