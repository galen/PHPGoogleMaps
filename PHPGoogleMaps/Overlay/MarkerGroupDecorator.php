<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Marker Decorator class that holds the marker's id and map
 * This passes function calls and variable requests to the marker
 *
 * Maps wrap markers in this decorator to give markers access to the map_id and marker id

 */
 

class MarkerGroupDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * Id of the marker group in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map id the marker group is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Array of markers in the group
	 *
	 * @var array
	 */
	protected $_markers = array();

	/**
	 * Constructor
	 * 
	 * @param Marker $marker Marker to decorate
	 * @param int $id ID of the marker in the map
	 * @param string $map Map Id of the map the marker is attached to
	 * @return MarkerDecorator
	 */
	public function __construct( MarkerGroup $group, $id, $map ) {
		parent::__construct( $group, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the marker group
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.marker_groups[%s]', $this->_map, $this->_id );
	}

	/**
	 * Get marker group toggle function
	 * Returns the javascript function call to toggle a marker group
	 * This will not work correctly if markers belong to more than one group
	 *
	 * @return string
	 */
	public function getToggleFunction() {
		return sprintf( "%s.marker_group_toggle('%s')", $this->_map, $this->var_name );
	}

	/**
	 * Add marker to group
	 * This allows the map object to insert marker IDs into the group
	 * You will not need to use this. Hopefully i'll find a better method of doing this
	 * so i can get rid of this.
	 *
	 * @var int $marker
	 * @return void
	 */
	public function addMarker( $marker ) {
		$this->_markers[] = (int) $marker;
	}

}