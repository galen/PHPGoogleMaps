<?php

namespace PHPGoogleMaps\overlay;

/**
 * Marker group class
 * This class is used to put markers into groups.
 * This is useful for hiding/showing markers with common attributes
 *
 * There are 4 ways to add a marker to a group
 *
 * 1. Create a group and pass that group to Marker::addToGroup() function of the marker
 *    $group = new \PHPGoogleMaps\Overlay\MarkerGroup( 'group' );
 *    $marker->addToGroup( $group );
 *
 * 2. Pass a group name to Marker::addToGroup()
 *    $marker->addToGroup( 'group' );
 *
 * 3. Pass a marker to MarkerGroup::addMarker()
 *    $group->addMarker( $marker );
 *
 * 4. Pass an array of markers to MarkerGroup::addMarkers()
 *    $group->addMarkers( $markers );
 *
 * Note: Be careful when naming groups. The group name you pass is turned into a 
 *       variable name by removing all non-word characters. This means there will be
 *       issues if you have a group named 'group 1' and 'group1' since both of their
 *       variables will be group1.
 */

class MarkerGroup extends \PHPGoogleMaps\Core\MapObject {

	/**
	 * Group name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Group variable name
	 * This is the group name with all non-word characters removed
	 * 
	 * @var string
	 */
	protected $var_name;

	/**
	 * Constructor
	 *
	 * @var string $group_name Name of the group
	 * @return MarkerGroup
	 */
	public function __construct( $group_name ) {
		$this->name = $group_name;
		$this->var_name = preg_replace( '~\W~', '', $group_name );
	}

	/**
	 * Static create function
	 * Used for method chaining
	 * 
	 * @param string $group_name Name of the group to create
	 * @return MarkerGroup
	 */
	public static function create( $group_name ) {
		return new MarkerGroup( $group_name );
	}

	/**
	 * Add a marker to the group
	 *
	 * @param Marker $marker Marker to add to the group
	 * @return MarkerGroup
	 */
	public function addMarker( \PHPGoogleMaps\Overlay\Marker $marker ) {
		$marker->addToGroup( $this );
		return $this;
	}

	/**
	 * Add an array of markers to the group
	 *
	 * @param array $markers Array of markers to add to the group
	 * @return MarkerGroup
	 */
	public function addMarkers( array $markers ) {
		foreach( $markers as $marker ) {
			$this->addMarker( $marker );
		}
		return $this;
	}

}