<?php

namespace PHPGoogleMaps\Overlay;

/**
 * GroundOverlay decorator class
 */

class GroundOverlayDecorator extends \PHPGoogleMaps\Core\MapObjectDecorator {

	/**
	 * ID of the marker in the map
	 *
	 * @var integer
	 */
	protected $_id;

	/**
	 * Map ID of the map the marker is attached to
	 *
	 * @var string
	 */
	protected $_map;

	/**
	 * Constructor
	 * 
	 * @param GroundOverlay $ground_overlay GroundOverlay to decorate
	 * @param int $id ID of the ground overlay in the map
	 * @param string $map Map Id of the map the ground overlay is attached to
	 * @return GroundOverlayDecorator
	 */
	public function __construct( GroundOverlay $ground_overlay, $id, $map ) {
		parent::__construct( $ground_overlay, array( '_id' => $id, '_map' => $map ) );
	}

	/**
	 * Returns the javascript variable of the ground overlay
	 * 
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.ground_overlays[%s]', $this->_map, $this->_id );
	}

}