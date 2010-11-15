<?php

namespace googlemaps\overlay;

/**
 * Directions Decorator
 *
 * Example:
 * This example will set the directions panel to the div with ID 'panel'
 *
 * $dir = new \googlemaps\overlay\DrivingDirections( 'New York, NY', 'San Jose, CA' );
 * $map->addObjects( array( $dir ) );
 * <a href="#" onclick="<?php echo $map->getDirections()->getRendererJsVar() ?>.setPanel(document.getElementById('panel'))">Set Panel</a>
 */

class DirectionsDecorator extends \googlemaps\core\MapObjectDecorator {

	/**
	 * Map id the fusion table is attached to
	 *
	 * @var string
	 */
	protected $map;

	/**
	 * Constructor
	 * 
	 * @param Directions $dir Directions to decorate
	 * @param string $map Map ID of the map the directions are attached to
	 * @return DirectionsDecorator
	 */
	public function __construct( Directions $dir, $map ) {
		parent::__construct( $dir, array( 'map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the directions renderer
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRenderer
	 *
	 * @return string
	 */
	public function getRendererJsVar() {
		return sprintf( '%s.directions.renderer', $this->map );
	}

	/**
	 * Returns the javascript variable of the directions service
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsService 
	 *
	 * @return string
	 */
	public function getServiceJsVar() {
		return sprintf( '%s.directions.service', $this->map );
	}




}