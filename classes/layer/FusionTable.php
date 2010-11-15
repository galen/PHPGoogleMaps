<?php

namespace googlemaps\layer;

/**
 * Fusion table class
 * Allows you to add fusion tables to your map
 * @link http://tables.googlelabs.com/
 */

class FusionTable extends \googlemaps\core\MapObject  {

	/**
	 * ID of the fusion table
	 *
	 * @var integer
	 */
	protected $table_id;

	/**
	 * Constructor
	 *
	 * @param int $table_id ID of the fusion table
	 * @param array $options Array of options
	 *                       @link http://code.google.com/apis/maps/documentation/javascript/reference.html#FusionTablesLayerOptions
	 * @return FusionTable
	 */
	public function __construct( $table_id, array $options=null ) {
		$this->table_id = $table_id;
		unset( $optoins['map'] );
		$this->options = $options;
	}

}