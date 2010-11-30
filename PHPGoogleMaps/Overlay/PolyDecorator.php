<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Poly decorator
 */

class PolyDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * ID of the poly in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map ID of the map the poly is attached to
	 *
	 * @var string
	 */
	protected $_map;
	 
	/**
	 * Constructor
	 *
	 * @param Poly $poly The poly to decorate
	 * @param int integer $id ID of the poly in the map
	 * @param string $map Map ID of the map the poly is attached to
	 */	
	public function __construct( Poly $poly, $id, $map ) {
		parent::__construct( $poly, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the poly
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.polys[%s]', $this->_map, $this->_id );
	}

}