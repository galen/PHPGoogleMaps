<?php

namespace googlemaps\core;

/**
 * Base class for some map objects
 * This helps separate critical functionality of an object from its options
 */

abstract class MapObject {

	/**
	 * Holds an array of options
	 * This is data that can be output to the page
	 *
	 * @var array
	 */
	public $options = array();

	/**
	 * Sets options and restricts the setting of variables that are marked as protected
	 *
	 * @param string $var
	 * @parram mixed $val
	 * @return void
	 */
	public function __set( $var, $val ) {
		$this->options[$var] = $val;
	}

	/**
	 * Returns an object variable
	 *
	 * @param string $var
	 * @return mixed
	 */
	public function __get( $var ) {
		if ( property_exists( $this, $var ) ) {
			return $this->$var;
		}
		else {
			return $this->options[$var];
		}
	}

	/**
	 * Return the options
	 *
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Magic isset method
	 * If a protected property with the passed variable name exists it returns isset() of that property
	 * Otherwise it will return isset() of the option
	 *
	 * @return boolean
	 */
	public function __isset( $var ) {
		if ( property_exists( $this, $var ) ) {
			return isset( $this->$var );
		}
		else {
			return isset( $this->options[$var] );
		}
	}

}