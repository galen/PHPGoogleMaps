<?php

namespace PHPGoogleMaps\Core;

/**
 * Map Object Decorator
 * This handles variable assignment and method calls
 * If the decorator responds to a method call or has a property the decorator method/variable will be used
 * Otherwise it will send the request to the decorated object
 *
 */

abstract class MapObjectDecorator {

	/**
	 * The object being decorated
	 *
	 * @var mixed
	 */
	protected $decoratee;

	/**
	 * Constructor
	 * 
	 * @param object $decoratee object to decorate
	 * @param array $properties Array of properties to set on the decorator
	 * @return MarkerDecorator
	 */
	public function __construct( $decoratee, array $properties ) {
		$this->decoratee = $decoratee;
		foreach( $properties as $var => $val ) {
			$this->$var = $val;
		}
	}

	/**
	 * Sends all function calls to the decorated object
	 *
	 * @param string $name Name of the variable
	 * @param array $arguments Array of arguments
	 * @return mixed
	 */
	public function __call( $name, $arguments ) {
		return $this->decoratee->$name( implode( ',', $arguments ) );
	}

	/**
	 * Sends all variable requests to the marker
	 *
	 * @param string $var Name of the variable
	 * @return mixed
	 */
	public function __get( $var ) {
		if ( property_exists( $this, $var ) ) {
			return $this->$var;
		}
		elseif ( isset( $this->decoratee->$var ) ) {
			return $this->decoratee->$var;
		}
		return null;
	}

	/**
	 * Sends all variable assignments to the decorated object
	 *
	 * @param string $var Name of the variable
	 * @param mixed $val Value of the variable
	 * @return void
	 */
	public function __set( $var, $val ) {
		if ( isset( $this->$var ) || property_exists( $this, $var ) ) {
			$this->$var = $val;
		}
		else {
			$this->decoratee->$var = $val;
		}
	}

	/**
	 * Magic isset function
	 *
	 * @param string $var Variable to test
	 * @return boolean
	 */
	public function __isset( $var ) {
		if ( property_exists( $this, $var ) ) {
			return isset( $this->$var );
		}
		else {
			return isset( $this->decoratee->$var );
		}
	}

	/**
	 * Get The object's javascript variable
	 *
	 * @return string
	 */
	abstract public function getJsVar();

	/**
	 * Magic __toString method
	 *
	 * Returns the javascript variable of the object
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getJsVar();
	}
}