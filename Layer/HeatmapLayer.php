<?php

namespace PHPGoogleMaps\Layer;

use PHPGoogleMaps\Core\LatLng;
use PHPGoogleMaps\Core\MapObject;

/**
 * Heatmap Layer
 *
 * @link https://developers.google.com/maps/documentation/javascript/heatmaplayer
 */
class HeatmapLayer extends MapObject
{

	/**
	 * Constructor
	 *
	 * @param array $options Array of options
	 */
	public function __construct(array $options = null)
	{
		if ($options) {
			unset($options['map']);
			$this->options = $options;
		}
	}

	/**
	 * Add a Coordinate
	 *
	 * @param LatLng $latLng
	 * @return void
	 */
	public function addLatLng(LatLng $latLng)
	{
		if (!isset($this->options['data'])) {
			$this->options['data'] = array();
		}
		$this->options['data'][] = $latLng;
	}

}