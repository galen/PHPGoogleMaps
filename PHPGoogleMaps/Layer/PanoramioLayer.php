<?php

namespace PHPGoogleMaps\Layer;

class PanoramioLayer extends \PHPGoogleMaps\Core\MapObject  {

	public function __construct( array $options=null ) {
		unset( $options['map'] );
		$this->options = $options;
	}

}