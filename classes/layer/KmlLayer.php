<?php

namespace googlemaps\layer;

class KmlLayer extends \googlemaps\core\MapObject  {

	protected $url;
	
	public function __construct( $url, array $options=null ) {
		$this->url = $url;
		unset( $options['map'] );
		$this->options = $options;
	}

}