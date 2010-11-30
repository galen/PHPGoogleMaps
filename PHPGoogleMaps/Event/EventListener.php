<?php

namespace PHPGoogleMaps\Event;

/**
 * Event listener class
 * This class will listen for events on the map
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * Example
 * This will listen for the idle event(fired when the map loads) and alert the user
 * $event = new \PHPGoogleMaps\Event\EventListener( 'idle', 'function(){alert("the map is loaded");}', true );
 * $map->addObject( $event );
 */

class EventListener extends \PHPGoogleMaps\Event\DomEventListener {

	/**
	 * The event to listen for
	 *
	 * @var string
	 */
	protected $event;
	
	/**
	 * The function to call
	 * Can be a name of a function that you've defined or a complete function.
	 * e.g. function(){ alert('Click!') }
	 *
	 * @var string
	 */
	protected $function;
	
	/**
	 * Once flag
	 * If true the event listener will be removed after the first call.
	 *
	 * @var boolean
	 */
	protected $once;

	/**
	 * Constructor
	 *
	 * @param string $event Event to listen for.
	 * @param string $function Function to call.
	 * @param boolean $once Once flag. If true the event listener will be removed after first call.
	 * @return EventListener
	 */
	public function __construct( $event, $function, $once=false ) {
		$this->event = $event;
		$this->function = $function;
		$this->once = $once;
	}

}