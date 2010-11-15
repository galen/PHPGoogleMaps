<?php

namespace googlemaps\overlay;

/**
 * Shape decorator
 */

class ShapeDecorator extends \googlemaps\core\MapObjectDecorator {

	/**
	 * ID of the shape in the map
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 * Map ID of the map the shape is attached to
	 *
	 * @var string
	 */
	protected $map;
	 
	/**
	 * Constructor
	 *
	 * @param Shape $shape The shape to decorate
	 * @param int integer $id ID of the shape in the map
	 * @param string $map Map ID of the map the shape is attached to
	 */	
	public function __construct( Shape $shape, $id, $map ) {
		parent::__construct( $shape, array( 'id' => $id, 'map' => $map ) );
	}

}