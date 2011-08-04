<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Marker Shape class for definign clickable regions of a marker
 * Define your shape then add it to a marker
 *
 * $shape = \PHPGoogleMaps\Marker\MarkerShape::createRect( 0,0,5,5 );
 * $icon->setShape( $shape );
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerShape
 */

class MarkerShape extends \PHPGoogleMaps\Core\MapObject {

	/**
	 * Type of Shape
	 * Rect, Poly or Circle
	 *
	 * @var string
	 */
	protected $type;
	
	/**
	 * Coordinates
	 * Vary depending on the shape
	 *
	 * @var array
	 */
	protected $coords = array();

	/**
	 * Array of variable names that can't be set without using a setter function
	 *
	 * @var array
	 */
	protected $protected_data = array( 'type', 'coords' );

	/**
	 * Private constructor
	 *
	 * @param string $type Type of shape ( circle, rect, poly )
	 * @param array $coords Array of coordinates associated with the shape
	 * @access private
	 * @return MarkerShape
	 */
	private function __construct( $type, array $coords ) {
		$this->type = $type;
		$this->coords = $coords;
	}

	/**
	 * Create a circle shape
	 * 
	 * @param $center_x X coord of the center of the circle
	 * @param center_y Y coord of the center of the circle
	 * @param $radius Radius of the circle
	 * @return MarkerShape
	 */
	public static function createCircle( $center_x, $center_y, $radius ) {
		return new MarkerShape( 'circle', array( $center_x, $center_y, $radius ) );
	}

	/**
	 * Create a poly shape
	 * 
	 * @param $coords Coordinates of the poly points
	 * @return MarkerShape
	 */
	public static function createPoly( array $coords ) {
		return new MarkerShape( 'poly', $coords );
	}

	/**
	 * Create a circle shape
	 * 
	 * @param $topleft_x X coord of the top left of the circle
	 * @param $topleft_y X coord of the top left of the circle
	 * @param $bottomright_x X coord of the bottom right of the circle
	 * @param $bottomright_y Y coord of the bottom right of the circle
	 * @return MarkerShape
	 */
	public static function createRect( $topleft_x, $topleft_y, $bottomright_x, $bottomright_y ) {
		return new MarkerShape( 'rect', array( $topleft_x, $topleft_y, $bottomright_x, $bottomright_y ) );
	}

}