<?php

namespace GoogleMaps\Layer;

class KmlLayer extends \GoogleMaps\Core\MapObject  {

	protected $url;
	
	public function __construct( $url, array $options=null ) {
		$this->url = $url;
		unset( $options['map'] );
		$this->options = $options;
	}

}