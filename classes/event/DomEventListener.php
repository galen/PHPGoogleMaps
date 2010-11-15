<?php

namespace googlemaps\event;

/**
 * DOM event listener class
 * This class will listen for events on DOM objects
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * Example:
 * This adds a click event listener to the element with Id #dom_element and alerts "you clicked me!"
 * $event = new \googlemaps\event\DOMEventListener( 'dom_element', 'click', 'function(){alert("you clicked me!");}' );
 * $map->addObject( $event );
 */

class DomEventListener extends \googlemaps\core\MapObject {

	/**
	 * The object to listen to
	 * This should be the ID of the DOM element to listen to
	 *
	 * @var string
	 */
	protected $object;
	
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
	 * If true the event listener will be removed after the first firing.
	 *
	 * @var boolean
	 */
	protected $once;

	/**
	 * Constructor
	 *
	 * @param string $object Object to listen to. This should be the ID of the DOM element to listen to.
	 * @param string $event Event to listen for.
	 * @param string $function Function to call.
	 * @param boolean $once Once flag. If true the event listener will be removed after first call.
	 * @return DOMEventListener
	 */
	public function __construct( $object, $event, $function, $once=false ) {
		$this->event = $event;
		$this->function = $function;
		$this->object = $object;
		$this->once = $once;
	}

}