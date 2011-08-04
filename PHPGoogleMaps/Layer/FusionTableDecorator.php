<?php

namespace PHPGoogleMaps\Layer;

/**
 * Fusion table decorator class
 * Gives access to the ID of the fusion tbale as well as the map it was attached to
 */
 

class FusionTableDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * Id of the fusion table in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map id the fusion table is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Constructor
	 * 
	 * @param FusionTable $ft Fusion Table to decorate
	 * @param int $id ID of the Fusion Table in the map
	 * @param string $map Map Id of the map the Fusion Table is attached to
	 * @return FusionTableDecorator
	 */
	public function __construct( FusionTable $ft, $id, $map ) {
		parent::__construct( $ft, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the Fusion Table
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.fusion_tables[%s]', $this->_map, $this->_id );
	}

}