<?php

namespace PHPGoogleMaps\Core;

/**
 * Marker Decorator class that holds the marker's id and map
 * This passes function calls and variable requests to the marker
 *
 * Maps wrap markers in this decorator to give markers access to the map_id and marker id
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
		return $this->decoratee->$var;
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


	public function __toString() {
		return $this->getJsVar();
	}
}