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
	* Call a function on all of a group's markers
	*
	* @param string $function_all_markers Javascript function to call on all map markers
	* This can be used to reset all markers to a default setting
	*
	* @param string $function_group_markers Javascript function to call on all group markers
	* This is called on the group markers after all markers have been "reset"
	*
	* @return string
	*/
	public function callFunction( $function_all_markers, $function_group_markers ) {
		return sprintf( "%s.marker_group_function('%s', %s, %s)", $this->_map, $this->var_name, $function_all_markers, $function_group_markers );
	}

}