<?php

namespace PHPGoogleMaps\Core;

/**
 * Static Map Object
 *
 * The map objects that can be placed in a static map extend this
 */

class StaticMapObject extends \PHPGoogleMaps\Core\MapObject {

	protected $static;

	/**
	 * Set static variable
	 *
	 * @param string $var variable to set
	 * @param string $val value to set the variable to
	 * @return void
	 */
	public function setStaticVar( $var, $val ) {
		if ( !isset( $this->static ) ) {
			$this->static = new \StdClass;
		}
		$this->static->$var = $val;
	}

	/**
	 * Get static variable
	 *
	 * @param string $var variable to get
	 * @return mixed
	 */
	public function getStaticVar( $var ) {
		return isset( $this->static, $this->static->$var ) ? $this->static->$var : null;
	}

}