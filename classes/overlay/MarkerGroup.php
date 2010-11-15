<?php

namespace googlemaps\overlay;

/**
 * Marker group class
 * This class is used to put markers into groups.
 * This is useful for hiding/showing markers with common attributes
 *
 * There are 2 ways to add a marker to a group
 *
 * 1. Create a group and pass that group to the addToGroup() function of the marker
 *    $group = new \googlemaps\overlay\MarkerGroup( 'group' );
 *    $marker->addToGroup( $group );
 *
 * 2. Pass a group name to addToGroup()
 *    $marker->addToGroup( 'group' );
 *
 * Note: Be careful when naming groups. The group name you pass is turned into a 
 *       variable name by removing all non-word characters. This means there will be
 *       issues if you have a group named 'group 1' and 'group1' since both of their
 *       variables will be group1.
 */

class MarkerGroup extends \googlemaps\core\MapObject {

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

}