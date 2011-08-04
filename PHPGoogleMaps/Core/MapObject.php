<?php

namespace PHPGoogleMaps\Core;

/**
 * Base class for map objects
 * This helps separate critical functionality of an object from its options
 */

abstract class MapObject {

	/**
	 * Holds an array of options
	 * This is data that can be output to the page
	 *
	 * @var array
	 */
	protected $options = array();

	/**
	 * Sets options and restricts the setting of important variables
	 *
	 * @param string $var
	 * @param mixed $val
	 * @return void
	 */
	public function __set( $var, $val ) {
		if ( !property_exists( $this, $var ) ) {
			$this->options[$var] = $val;
		}
	}

	/**
	 * Also used for setting options, some people prefer object::setVar() to object->var =
	 *
	 * @param string $method
	 * @param mixed $val
	 * @return void
	 */
	public function __call( $method, $val ) {
		if ( substr( $method, 0, 3 ) == 'set' ) {
			$this->options[strtolower( substr( $method, 3 ) )] = $val[0];
		}
	}

	/**
	 * Return an object variable
	 * Will check for a property first
	 * Then an option
	 * If neither is found, null is returned
	 *
	 * @param string $var
	 * @return mixed
	 */
	public function __get( $var ) {
		if ( property_exists( $this, $var ) ) {
			return $this->$var;
		}
		elseif ( isset( $this->options[$var] ) ) {
			return $this->options[$var];
		}
		else {
			return null;
		}
	}

	/**
	 * Return an option
	 *
	 * @param string $option Option to return
	 * @return mixed
	 */
	public function getOption( $option ) {
		return isset( $this->options[$option] ) ? $this->options[$option] : false;
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
	 * Remove an option
	 *
	 * @param string $option Option to remove
	 * @return void
	 */
	public function removeOption( $option ) {
		unset( $this->options[$option] );
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