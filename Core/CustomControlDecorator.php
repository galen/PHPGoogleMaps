<?php

namespace PHPGoogleMaps\Core;

/**
 * CustomControl decorator class
 * This holds the custom control's id and map
 */

class CustomControlDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * ID of the custom control in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map ID of the map the custom control is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Constructor
	 * 
	 * @param CustonControl $control Custom control to decorate
	 * @param int $id ID of the custom control in the map
	 * @param string $map Map ID of the map the custom control is attached to
	 * @return CustomControl
	 */
	public function __construct( CustomControl $control, $id, $map ) {
		parent::__construct( $control, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the custom control
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.custom_controls[%s]', $this->_map, $this->_id );
	}
	
}