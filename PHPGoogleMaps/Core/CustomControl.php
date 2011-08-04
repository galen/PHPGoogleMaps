<?php

namespace PHPGoogleMaps\Core;

/**
 * CustomControl Class
 * Adds a custom control to a map
 * @link http://code.google.com/apis/maps/documentation/javascript/examples/control-custom.html
 */

class CustomControl extends \PHPGoogleMaps\Core\MapObject {

	/** 
	 * Custom control position
	 *
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#ControlPosition
	 *
	 * @var string
	 */
	protected $position = 'TOP_RIGHT';

	/**
	 * Control listeners
	 *
	 * All the listeners that have been added to the control
	 *
	 * @var array
	 */
	protected $listeners = array();

	/**
	 * Constructor
	 *
	 * @param array $outeroptions array of control's wrapper options
	 * @param array $inner_options array of control's inner options
	 * @return CustomControl
	 */
	public function __construct( array $outer_options=null, array $inner_options=null, $position=null ) {
		$this->options['outer'] = $outer_options;
		$this->options['inner'] = $inner_options;
		if ( $position ) {
			$this->position = $position;
		}
	}

	/**
	 * Add Listener
	 *
	 * Add a listener to the control
	 *
	 * @param string $event Event to listen for (click)
	 * @param string $function Function to call
	 * @return void
	 */
	public function addListener( $event, $function ) {
		$this->listeners[] = array(
			'event'		=> $event,
			'function'	=> $function
		);
	}

}