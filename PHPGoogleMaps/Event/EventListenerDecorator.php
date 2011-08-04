<?php

namespace PHPGoogleMaps\Event;

/**
 * Event listener decorator class
 * This holds the event listener's id and map
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * Maps wrap event listeners in this decorator to give access to the map_id and event listener id
 */

class EventListenerDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * ID of the event listener in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map ID of the map the event listener is attached to
	 *
	 * @var string
	 */
	protected $_map;
	 
	/**
	 * Constructor
	 *
	 * @param DOMEventListener $listener The event listener to decorate
	 * @param int integer $id ID of the event listener in the map
	 * @param string $map Map ID of the map the event listener is attached to
	 */	
	public function __construct( EventListener $listener, $id, $map ) {
		parent::__construct( $listener, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Get javascript variable
	 *
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.event_listeners[%s]', $this->_map, $this->_id );
	}

}