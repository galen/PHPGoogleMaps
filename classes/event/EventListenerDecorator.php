<?php

namespace googlemaps\event;

/**
 * Event listener decorator class
 * This holds the event listener's id and map
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * Maps wrap event listeners in this decorator to give access to the map_id and event listener id
 */

class EventListenerDecorator extends \googlemaps\core\MapObjectDecorator {

	/**
	 * ID of the marker in the map
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 * Map ID of the map the marker is attached to
	 *
	 * @var string
	 */
	protected $map;
	 
	/**
	 * Constructor
	 *
	 * @param DOMEventListener $listener The event listener to decorate
	 * @param int integer $id ID of the marker in the map
	 * @param string $map Map ID of the map the event listener is attached to
	 */	
	public function __construct( DOMEventListener $listener, $id, $map ) {
		parent::__construct( $listener, array( 'id' => $id, 'map' => $map ) );
	}

}