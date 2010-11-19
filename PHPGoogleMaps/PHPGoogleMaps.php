<?php

/**
 * This is the only file you need to include
 * This autoloads all classes, no need to include any files
 */

function phpGoogleMapAutoloader( $str ) {
	
	require( __DIR__ . str_replace( '\\', DIRECTORY_SEPARATOR, '/' .  $str ) . '.php' );

}

spl_autoload_register( 'phpGoogleMapAutoloader' );