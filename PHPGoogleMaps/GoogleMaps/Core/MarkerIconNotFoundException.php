<?php

namespace GoogleMaps\Core;

/**
 * Marker Icon exception
 */
class MarkerIconNotFoundException extends \Exception {

	/**
	 * Invalid icon image
	 *
	 * @var string
	 */
	public $image;

	/**
	 * Constructor
	 *
	 * @param string $image Invalid image URL
	 * @returns MarkerIconNotFoundException
	 */
	public function __construct( $image ) {
		$this->image = $image;
		parent::__construct();
	}

}