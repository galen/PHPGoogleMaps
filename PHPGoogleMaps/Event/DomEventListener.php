<?php

namespace PHPGoogleMaps\Event;

/**
 * DOM event listener class
 * This class will listen for events on DOM objects
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * Example:
 * This adds a click event listener to the element with Id #dom_element and alerts "you clicked me!"
 * $event = new \PHPGoogleMaps\Event\DOMEventListener( 'dom_element', 'click', 'function(){alert("you clicked me!");}' );
 * $map->addObject( $event );
 */

class DomEventListener extends \PHPGoogleMaps\Event\EventListener {}