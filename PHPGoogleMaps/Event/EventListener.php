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

class EventListener extends \PHPGoogleMaps\Event\DomEventListener {}