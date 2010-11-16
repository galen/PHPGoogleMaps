<?php

/**
 * This is the only file you need to include
 * This autoloads all classes, no need to include any files
 */

function autoloader( $class ) {
	$class_parts = explode( '\\', $class );
	if ( count( $class_parts ) > 1 ) {
		unset( $class_parts[0] );
	}
	$class_file = array_pop( $class_parts );
	$class_path = strtolower( implode( '/', $class_parts ) );
	if ( stripos( $class_file, 'directions' ) > 0 ) {
		$class_file = 'Directions';
	}
	$class_final = $class_path . '/' . $class_file;
	require( __DIR__ . '/classes/' . $class_final . '.php' );
}

spl_autoload_register( 'autoloader' );