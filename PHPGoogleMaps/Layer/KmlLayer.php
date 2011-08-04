<?php

namespace PHPGoogleMaps\Layer;

class KmlLayer extends \PHPGoogleMaps\Core\MapObject  {

	protected $url;
	
	public function __construct( $url, array $options=null ) {
		$this->url = $url;
		unset( $options['map'] );
		$this->options = $options;
	}

}