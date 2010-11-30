<?php

/**
 * This is the only file you need to include.
 * This autoloads all classes, no need to include any files.
 */
namespace PHPGoogleMaps\Core;

class PHPGoogleMapsAutoLoader {
	static function load( $class ) {
		require( dirname( dirname( __DIR__ ) ) . str_replace( '\\', DIRECTORY_SEPARATOR, '/' .  $class ) . '.php' );
	}
}

spl_autoload_register( 'PHPGoogleMaps\Core\PHPGoogleMapsAutoLoader::load' );
