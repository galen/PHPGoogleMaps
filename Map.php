<?php

/**
 * Google Maps API
 * PHP Wrapper for Google Maps v3
 * @author Galen Grover <galenjr@gmail.com>
 * @package PHPGoogleMaps
*/


namespace PHPGoogleMaps;

/**
 * Google Map
 *
 * The main class that controls the output of a map
 * All map objects must be added to an instance of a GoogleMap via addObject() or addObjects()
 *
 * Using addObject() decorates the object to provide extra functionality
 * $marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY' );
 * $map->addObject( $marker );
 * echo $marker->getJsVar(); // Echos map.markers[0]
 *
 * If adding multiple objects with addObjects() you can do the same by passing the object by
 * reference, but this is deprecated as of PHP 5.3
 * $marker1 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'New York, NY' );
 * $marker2 = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'San Diego, CA' ); 
 * $map->addObjects( array( &$marker1, $marker2 ) );
 * echo $marker1->getJsVar(); // Echos map.markers[0]
 *
 */

class Map {

	/**
	 * Map ID
	 *
	 * ID of the map. This will be used for CSS and javascript.
	 * 
	 * @var string
	 */
	private $map_id = 'map';

	/**
	 * Map language
	 *
	 * Language of the map.
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Localization
	 * 
	 * @var string
	 */
	private $language;

	/**
	 * Map region
	 *
	 * Region of the map.
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Localization
	 * 
	 * @var string
	 */
	private $region;

	/**
	 * Sensor
	 *
	 * Device's GPS abilities
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#SpecifyingSensor
	 * 
	 * @var string
	 */
	private $sensor = false;

	/**
	 * Version of the API to use
	 * Leave this at 3 to use the latest version
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Versioning
	 *
	 * @var int
	 */
	private $api_version = 3;


	/**
	 * Map type
	 * This controls what type of map to display (roadmap, satellite, terrain, hybrid)
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeId
	 *
	 *@var string
	 */
	private $map_type = 'roadmap';

	/**
	 * Zoom level
	 *
	 * @var int
	 */
	private $zoom = 7;

	/**
	 * Auto encompass flag
	 * If enabled the map will automatically encompass all markers on the map
	 * If disabled a zoom level and center must be set
	 *
	 * @var boolean
	 */
	private $auto_encompass = true;

	/**
	 * Units
	 * If unset map will use default units of the users location
	 *
	 * @var string
	 */
	private $units;

	/**
	 * Map height
	 * Example: 500px, 100%
	 * 
	 * @var string
	 */
	private $height = '500px';
	
	/**
	 * Map width
	 * Example: 500px, 100%
	 *
	 * @var string
	 */
	private $width = '500px';

	/**
	 * Map center
	 *
	 * @var LatLng
	 */
	private $center;

	/**
	 * Center on user flag
	 * If set the map will attempt to set the center on the user's location
	 *
	 * @var boolean
	 */
	private $center_on_user = false;

	/**
	 * Navigation control flag
	 * Show/hide the navigation control
	 *
	 * @var boolean
	 */
	private $navigation_control = true;
	
	/**
	 * Navigation control position
	 *
	 * @var string
	 */
	private $navigation_control_position;

	/**
	 * Navigation control style
	 *
	 * @var string
	 */
	private $navigation_control_style;

	/**
	 * Map type control flag
	 * Show/hide the map type control
	 *
	 * @var boolean
	 */
	private $map_type_control = true;

	/**
	 * Map type control position
	 *
	 * @var string
	 */
	private $map_type_control_position;

	/**
	 * Map type control style
	 *
	 * @var string
	 */
	private $map_type_control_style;

	/**
	 * Available map types
	 * Array of map types that will be available for the user to choose
	 *
	 * @var array
	 */
	private $map_types = array();
	
	/**
	 * Map styles
	 * Custom map styles
	 *
	 * @var array
	 */
	private $map_styles = array();

	/**
	 * Scale control flag
	 *
	 * @var boolean
	 */
	private $scale_control = false;
	
	/**
	 * Scale control position
	 *
	 * @var string
	 */
	private $scale_control_position;

	/**
	 * Map custom controls
	 * Array of custom controls added to the map
	 *
	 * @var array
	 */
	private $custom_controls = array();

	/**
	 * Map shapes
	 * Array of shapes added to the map
	 *
	 * @var array
	 */
	private $shapes = array();

	/**
	 * Map polys
	 * Array of polygons and polylines added to the map
	 *
	 * @var array
	 */
	private $polys = array();


	/**
	 * Scrollable flag
	 *
	 * Allows the map to be zoomed with the scrollbar
	 * 
	 * @var boolean
	 */
	private $scrollable = true;

	/**
	 * Draggable flag
	 *
	 * Allows the map to be dragged
	 * 
	 * @var boolean
	 */
	private $draggable = true;

	/**
	 * Default marker icon
	 * Default marker icon of the map
	 *
	 * @var MarkerIcon
	 */
	private $default_marker_icon;
	
	/**
	 * Default marker shadow
	 * Default marker shadow of the map
	 *
	 * @var MarkerIcon
	 */
	private $default_marker_shadow = null;

	/**
	 * Stagger markers
	 * Time in milliseconds to stagger the marker additions
	 *
	 * @var integer
	 */
	 private $stagger_markers = 0;

	/**
	 * Map markers
	 *
	 * @var array
	 */
	private $markers = array();

	/**
	 * Hash of the marker data
	 * This is used to keep from extracting the same marker data
	 *
	 * @var string
	 */
	private $marker_data_hash;

	/**
	 * Marker icons
	 * All the maps marker icons
	 *
	 * @var array
	 */
	private $marker_icons = array();

	/**
	 * Marker shapes
	 * All the maps marker shapes
	 *
	 * @var array
	 */
	private $marker_shapes = array();

	/**
	 * Marker Groups
	 * All the maps marker groups
	 *
	 * @var array
	 */
	private $marker_groups = array();

	/**
	 * Fusion tables
	 * Array of fusion tables added to the map
	 * 
	 * @var array
	 */
	private $fusion_tables = array();

	/**
	 * KML layers
	 * Array of KML layers added to the map
	 * 
	 * @var array
	 */
	private $kml_layers = array();

	/**
	 * Panoramio layers
	 * Array of Panoramio layers added to the map
	 * 
	 * @var array
	 */
	private $panoramio_layers = array();

	/**
	 * Ground overlays
	 * Array of ground overlays added to the map
	 * 
	 * @var array
	 */
	private $ground_overlays = array();

	/**
	 * Traffic layer flag
	 * 
	 * @var boolean
	 */
	private $traffic_layer = false;

	/**
	 * Streetview
	 * 
	 * @var boolean
	 */
	private $streetview;

	/**
	 * Bicycle layer flag
	 * 
	 * @var boolean
	 */
	private $bicycle_layer = false;

	/**
	 * Event listeners
	 * Holds the array of event listeners
	 *
	 * @var array
	 */
	private $event_listeners = array();

	/**
	 * Infowindow flag
	 *
	 * @var boolean
	 */
	private $info_windows = true;

	/**
	 * Compressed output flag
	 * Removes all unecessary white space from the javascript code
	 *
	 * @var boolean
	 */
	private $compress_output = false;

	/**
	 * Geolocation flag
	 *
	 * @var boolean
	 */
	private $geolocation = false;
	
	/**
	 * Geolocation timeout
	 * This is the amount of time in milliseconds that the browser will attempt geolocation
	 * @link http://dev.w3.org/geo/api/spec-source.html#position_options_interface
	 *
	 * @var int
	 */
	private $geolocation_timeout = 6000;
	
	/**
	 * Geolocation high accuracy
	 * Attempt high accuracy geolocation
	 * @link http://dev.w3.org/geo/api/spec-source.html#position_options_interface
	 *
	 * @var boolean
	 */
	private $geolocation_high_accuracy = false;
	
	/**
	 * Geolocation fail callback
	 * Function to call if geolocation fails
	 *
	 * @var string
	 */
	private $geolocation_fail_callback;

	/**
	 * Geolocation success callback
	 * Function to call if geolocation succeeds
	 *
	 * @var string
	 */
	private $geolocation_success_callback;

	/**
	 * Backup geolocation location
	 * If the map was centered via geolocation and geolocation fails
	 * this will set as the map center
	 *
	 * @var LatLng
	 */
	private $geolocation_backup;
	
	/**
	 * Mobile flag
	 * This will output a special meta tag for mobile devices
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Mobile
	 *
	 * @var boolean
	 */
	private $mobile = false;

	/**
	 * Mobile iphone fullscreen flag
	 * This will hide the navigation bar on the iphone
	 *
	 * @var boolean
	 */
	private $mobile_iphone_fullscreen = false;

	/**
	 * Map Directions
	 *
	 * @var Directions
	 */
	private $directions;
	
	/**
	 * Array of map binds
	 *
	 * @var array
	 */
	private $binds = array();

	/**
	 * Array of google map libraries to load
	 *
	 * @var array
	 */
	private $libraries = array();

	/**
	 * Adsense flag
	 *
	 * @var boolean
	 */
	private $adsense = false;

	/**
	 * Adsense publisher id
	 *
	 * @var string
	 */
	private $adsense_publisher_id = null;

	/**
	 * Adsense format
	 *
	 * @var string
	 */
	private $adsense_format = 'banner';

	/**
	 * Adsense position
	 *
	 * @var
	 */
	private $adsense_position = 'bottom';

	/**
	 * Adsense visibility
	 *
	 * @var boolean
	 */
	private $adsense_visible = true;

	/**
	 * Clustering javascript
	 *
	 * This will hold the location of the file
	 *
	 * @var string
	 */
	private $clustering_js;

	/**
	 * Clustering options
	 *
	 * @var array
	 */
	private $clustering_options = array();

	/**
	 * Loading content
	 *
	 * @var string
	 */
	private $loading_content;

	/**
	 * Constructor
	 *
	 * @var string $map_id ID to give the map
	 * @return GoogleMap
	 */
	public function __construct( array $options=null ) {
		if ( $options ) {
			foreach( $options as $option_var => $option_val ) {
				switch ( $option_var ) {
					case 'zoom':
						$this->setZoom( $option_val );
						break;
					case 'map_id':
						$this->map_id = $this->normalizeVariable( $option_val );
						break;
					case 'center':
						$this->setCenter( $option_val );
						break;
					case 'language':
						$this->setLanguage( $option_val );
						break;
					case 'region':
						$this->setRegion($option_val);
						break;
					case 'sensor':
						$option_val ? $this->enableSensor() : $this->disableSensor();
						break;
					case 'api_version':
						$this->setApiVersion($option_val);
						break;
					case 'auto_encompass':
						$option_val ? $this->enableAutoEncompass() : $this->disableAutoEncompass();
						break;
					case 'units':
						$this->setUnits($option_val);
						break;
					case 'height':
						$this->setHeight($option_val);
						break;
					case 'width':
						$this->setWidth($option_val);
						break;
					case 'center_on_user':
						$this->setCenterByUserLocation( isset( $options['center_on_user_backup'] ) ? $options['center_on_user_backup'] : null );
						break;
					case 'navigation_control':
						$option_val ? $this->enableNavigationControl() : $this->disableNavigationControl();
						break;
					case 'navigation_control_position':
						$this->setNavigationControlPosition($option_val);
						break;
					case 'navigation_control_style':
						$this->setNavigationControlStyle($option_val);
						break;
					case 'map_type_control':
						$option_val ? $this->enableMapTypeControl() : $this->disableMapTypeControl();
						break;
					case 'map_type_control_position':
						$this->setMapTypeControlPosition($option_val);
						break;
					case 'map_type_control_style':
						$this->setMapTypeControlStyle($option_val);
						break;
					case 'scale_control':
						$option_val ? $this->enableScaleControl() : $this->disableScaleControl();
						break;
					case 'scale_control_position':
						$this->setScaleControlPosition($option_val);
						break;
					case 'scrollable':
						$option_val ? $this->enableScrolling() : $this->disableScrolling();
						break;
					case 'draggable':
						$option_val ? $this->enableDragging() : $this->disableDragging();
						break;
					case 'bicycle_layer':
						$option_val ? $this->enableBicycleLayer() : $this->disableBicycleLayer();
						break;
					case 'traffic_layer':
						$option_val ? $this->enableTrafficLayer() : $this->disableTrafficLayer();
						break;
					case 'geolocation':
						$timeout = isset( $options['geolocation_timeout'] ) ? (int) $options['geolocation_timeout'] : null;
						$high_accuracy = isset( $options['geolocation_high_accuracy'] ) ? (bool) $options['geolocation_high_accuracy'] : null;
						$this->enableGeolocation( $timeout, $high_accuracy );
						break;
					case 'info_windows':
						$option_val ? $this->enableInfoWindows() : $this->disableInfoWindows();
						break;
					case 'compress_output':
						$option_val ? $this->enableCompressedOutput() : $this->disableCompressedOutput();
						break;
				}
			}
		}
	}

	function setLoadingContent( $content ) {
		$this->loading_content = $content;
	}

/*************************
 *
 * Static map
 *
 ************************/

	/**
	 * Get a static map url
	 *
	 * This will turn your map into a static map url
	 *
	 *
	 * @param string $format Image format
	 * @param array $visible Array of visible locations
	 * @return string
	 */

	function getStaticMap( $format='png', array $visible = null ) {
	
		$url = "http://maps.google.com/maps/api/staticmap?";
		$request = '';
		$request .= sprintf( "size=%sx%s&", intval( $this->width ), intval( $this->height ) );
		$request .= sprintf( "sensor=%s&", $this->sensor ? 'true' : 'false' );
		$request .= sprintf( "format=%s&", $format );
		$request .= sprintf( "maptype=%s&", $this->map_type );
		$request .= sprintf( "language=%s&", $this->language );
		if ( is_array( $visible ) ) {
			$request .= sprintf( "visible=%s&", implode( '|', $visible ) );
		}
		if ( $this->center instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$request .= sprintf( "center=%s,%s&", $this->center->getLat(), $this->center->getLng() );
			$request .= sprintf( "zoom=%s&", $this->zoom );
		}
		foreach( $this->markers as $marker ) {
			$request .= sprintf( "markers=size:%s|color:%s|label:%s|%sshadow:%s|%s,%s&",
				isset( $marker->static->size ) ? $marker->static->size : '',
				isset( $marker->static->color ) ? $marker->static->color : '',
				isset( $marker->static->label ) ? strtoupper( (string) $marker->static->label[0] ) : '',
				$marker->icon ? sprintf( 'icon:%s|', $marker->icon ) : '',
				isset( $marker->static->flat ) ?  ( ( $marker->static->flat ) ? 'false' : 'true' ) : '',
				$marker->position->getLat(), $marker->position->getLng()
			);
		}
		return sprintf( "%s%s", $url, $request );
	
	}

	/**
	 * Validate a static map
	 *
	 * Wil return true or an http error code
	 *
	 * @param string $format Image format
	 * @param array $visible Array of visible locations
	 * @return boolean|int
	 */
	function validateStaticMap( $format='png', array $visible = null ) {
		$headers = get_headers($this->getStaticMap( $format, $visible ));
		if ( $headers ) {
			if ( strpos( $headers[0], '200' ) ) {
				return true;
			}
			return array_slice( explode( ' ', $headers[0] ), 1, 1 );
		}
	}

	/**
	 * Print the satic map url
	 *
	 * @param string $format Image format
	 * @param array $visible Array of visible locations
	 * @return void
	 */
	function printStaticMap( $format='png', array $visible = null ) {
		echo $this->getStaticMap( $format, $visible );
	}

/*************************
 *
 * Directions
 *
 *************************/

	/**
	 * Add directions to the map
	 *
	 * @param Directions $dir Directions object
	 * @return DirectionsDecorator
	 */
	protected function addDirections( \PHPGoogleMaps\Service\Directions $dir ) {
		return $this->directions = new \PHPGoogleMaps\Service\DirectionsDecorator( $dir, $this->map_id );
	}

	/**
	 * Get the map directions
	 *
	 * @return DirectionsDecorator
	 */
	public function getDirections() {
		return $this->directions;
	}


/************************************************
 * 
 * Layers
 *
 *************************************************/

	/**
	 * Enable streetview
	 *
	 * @return void
	 */
	public function enableStreetView( array $options=null, $container=null ) {
		$default_options = array(
			'visible'			=> isset( $options['position'] ) && $options['position'] == true ? true : false,
			'enableCloseButton'	=> true,
			'pov'				=> array(
				'heading'	=> 90,
				'zoom'		=> 1,
				'pitch'		=> 0
			)
		);
		$this->streetview = new \StdClass;
		if ( $container ) {
			$this->streetview->container = $container;
		}
		else {
			$this->streetview->container = $this->map_id;
		}
		
		if ( isset( $options['position'] ) ) {
			if ( $options['position'] == 'geolocation' ) {
					$this->enableGeolocation();
					$options['position'] = "geolocation";
			}
			elseif ( $options['position'] instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
				$options['position'] = $options['position']->getLatLng();
			}
			else {
				$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $options['position'] );
				if ( $geocode_result instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
					$options['position'] = $geocode_result->getLatLng();
				}
				else {
					throw new \PHPGoogleMaps\Service\GeocodeException( $geocode_result );
				}
			}		
		}		
		$this->streetview->options = (array)$options + $default_options;
	}

	/**
	 * Enable sensor
	 *
	 * @return void
	 */
	public function enableSensor() {
		$this->sensor = true;
	}

	/**
	 * Disable sensor
	 *
	 * @return void
	 */
	public function disableSensor() {
		$this->sensor = false;
	}

	/**
	 * Enable traffic layer
	 *
	 * @return void
	 */
	public function enableTrafficLayer() {
		$this->traffic_layer = true;
	}

	/**
	 * disable traffic layer
	 *
	 * @return void
	 */
	public function disableTrafficLayer() {
		$this->traffic_layer = false;
	}

	/**
	 * Enable bicycle layer
	 *
	 * @return void
	 */
	public function enableBicycleLayer() {
		$this->bicycle_layer = true;
	}

	/**
	 * Disable bicycle layer
	 *
	 * @return void
	 */
	public function disableBicycleLayer() {
		$this->bicycle_layer = false;
	}

	/**
	 * Enable info windows
	 *
	 * @return void
	 */
	public function enableInfoWindows() {
		$this->info_windows = true;
	}

	/**
	 * Disable info windows
	 *
	 * @return void
	 */
	public function disableInfoWindows() {
		$this->info_windows = false;
	}

	/**
	 * Return info window status
	 *
	 * @return boolean
	 */
	public function infoWindows() {
		return $this->info_windows;
	}

	/**
	 * Add a fusion table to the map
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#FusionTablesLayer
	 * @link http://tables.googlelabs.com/
	 *
	 * @param FusionTable $ft Fusion table to add to the map
	 * @return FusionTableDecorator
	 * @access protected
	 */
	protected function addFusionTable( \PHPGoogleMaps\Layer\FusionTable $ft ) {
		return $this->fusion_tables[] = new \PHPGoogleMaps\Layer\FusionTableDecorator( $ft, count( $this->fusion_tables ), $this->map_id );
	}

	/**
	 * Get the array of the map's fusion tables
	 *
	 * @return array
	 */
	public function getFusionTables() {
		return $this->fusion_tables;
	}

	/**
	 * Add a KML layer to the map
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#KmlLayer
	 * @link http://code.google.com/apis/maps/documentation/javascript/overlays.html#KMLLayers
	 *
	 * @param KmlLayer $kml KML layer to add to the map
	 * @return KmlLayerDecorator
	 * @access protected
	 */
	protected function addKmlLayer( \PHPGoogleMaps\Layer\KmlLayer $kml ) {
		return $this->kml_layers[] = new \PHPGoogleMaps\Layer\KmlLayerDecorator( $kml, count( $this->kml_layers ), $this->map_id );
	}

	/**
	 * Add a Panoramio layer to the map
	 * @link http://code.google.com/apis/maps/documentation/javascript/overlays.html#PanoramioLibrary
	 *
	 * @param PanoramioLayer $panoramio Panoramio layer to add to the map
	 * @return PanoramioLayerDecorator
	 * @access protected
	 */
	protected function addPanoramioLayer( \PHPGoogleMaps\Layer\PanoramioLayer $panoramio ) {
		return $this->panoramio_layers[] = new \PHPGoogleMaps\Layer\PanoramioLayerDecorator( $panoramio, count( $this->panoramio_layers ), $this->map_id );
	}

	/**
	 * Add a ground overlay to the map
	 *
	 * @param GroundOverlay $ground_overlay ground overlay to add to the map
	 * @return GroundOverlayDecorator
	 * @access protected
	 */
	protected function addGroundOverlay( \PHPGoogleMaps\Overlay\GroundOverlay $ground_overlay ) {
		return $this->ground_overlays[] = new \PHPGoogleMaps\Overlay\GroundOverlayDecorator( $ground_overlay, count( $this->ground_overlays ), $this->map_id );
	}

	/**
	 * Get the array of the map's KML layers
	 *
	 * @return array
	 */
	public function getKmlLayers() {
		return $this->kml_layers;
	}

	/**
	 * Add a shape to the map
	 *
	 * @param Shape $shape Shape to add to the map
	 * @return ShapeDecorator
	 * @access protected
	 */
	protected function addShape( \PHPGoogleMaps\Overlay\Shape $shape ) {
		return $this->shapes[] = new \PHPGoogleMaps\Overlay\ShapeDecorator( $shape, count( $this->shapes ), $this->map_id );
	}

	/**
	 * Get the array of the map's shapes
	 *
	 * @return array
	 */
	public function getShapes() {
		return $this->shapes;
	}

	/**
	 * Add a polygon to the map
	 *
	 * @param Shape $shape Shape to add to the map
	 * @return ShapeDecorator
	 * @access protected
	 */
	protected function addPoly( \PHPGoogleMaps\Overlay\Poly $poly ) {
		return $this->polys[] = new \PHPGoogleMaps\Overlay\PolyDecorator( $poly, count( $this->polys ), $this->map_id );
	}

/************************************************
 * 
 * Map Options
 *
 ************************************************/

	/**
	 * Add a custom control to the map
	 *
	 * @param Marker $marker Marker to add
	 * @return MarkerDecorator
	 * @access protected
	 */
	protected function addCustomControl( \PHPGoogleMaps\Core\CustomControl $control ) {
		return $this->custom_controls[] = new \PHPGoogleMaps\Core\CustomControlDecorator( $control, count( $this->custom_controls ), $this->map_id );
	}

	/**
	 * Set map center
	 *
	 * @param string|PositionAbstract $center Location of the center. Can be a
	 *                                location or an object that extends PositionAbstract.
	 * @return boolean
	 */
	public function setCenter( $center ) {
		if ( $center instanceof \PHPGoogleMaps\Core\PositionAbstract ) {
			$this->center = $center->getLatLng();
			return true;
		}
		$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( (string)$center );
		if ( $geocode_result instanceof \PHPGoogleMaps\Service\GeocodeResult ) {
			$this->center = $geocode_result->getLatLng();
			return true;
		}
		return false;
	}
	/**
	 * Set map center by coordinates
	 * 
	 * Convenience function for setting the center via a lat/lng 
	 *
	 * @var float $lat latitude
	 * @var float $lng longitude
	 * @return void
	 */
	public function setCenterCoords( $lat, $lng ) {
		$this->setCenter( new \PHPGoogleMaps\Core\LatLng( floatval( $lat ), floatval( $lng ) ) );
	}

	/**
	 * Set map center by user location
	 *
	 * @param string $backup_location Backup location incase geolocation fails
	 * @return void
	 */
	public function centerOnUser( \PHPGoogleMaps\Core\PositionAbstract $backup_location=null ) {
		$this->enableGeolocation();
		$this->center_on_user = true;
		if ( $backup_location !== null ) {
			$this->geolocation_backup = $backup_location;
		}
	}

	/**
	 * Add a map style
	 *
	 * @param MapStyle $style The map style
	 * @return void
	 */
	protected function addMapStyle( \PHPGoogleMaps\Overlay\MapStyle $style ) {
		return $this->map_styles[$style->var_name] = $style;
	}

	/**
	 * Set the map's types
	 * This sets what type of map's will be selectable by the user
	 * This must be called explicitly if you are adding custom map styles
	 *
	 * @param array $map_types Array of map types to enable
	 * @return void
	 */
	function setMapTypes( array $map_types ) {
		foreach ( $map_types as $map_type ) {
			if ( $map_type instanceof \PHPGoogleMaps\Overlay\MapStyle ) {
				$this->map_types[] = $map_type->var_name;
			}
			else {
				$this->map_types[] = $map_type;
			}
		}
	}

	/**
	 * Get sidebar HTML
	 *
	 * @param string $marker_html Custom HTML to use for each marker in the sidebar
	 *                            use {title}, {content}, {icon} in the HTML as placeholders
	 * @param integer $tabs_deep The amount of tabs to indent the code
	 * @return string
	 */
	public function getSidebar( $marker_html='', $tabs_deep=0 ) {
		$sidebar_html = sprintf( "%s<div id=\"%s_sidebar\">\n%s<ul class=\"sidebar\">\n", str_repeat( "\t", $tabs_deep ), $this->map_id, str_repeat( "\t", $tabs_deep+1 ) );
		foreach( $this->getMarkers() as $marker ) {
			if ( isset( $marker->sidebar ) && $marker->sidebar === false ) {
				continue;
			}
			if ( $marker_html ) {
				$marker_parsed_html = str_replace( array( '{title}', '{content}', '{icon}' ), array( $marker->title, $marker->content, $marker->icon instanceof \PHPGoogleMaps\Overlay\MarkerIcon ? $marker->icon->icon : '' ), $marker_html );
			}
			$sidebar_html .= sprintf( "%s<li onclick=\"google.maps.event.trigger(%s, 'click')\">\n%s%s%s</li>\n",
				str_repeat( "\t", $tabs_deep+2 ),
				$marker->getJsVar(),
				str_repeat( "\t", $tabs_deep+3 ),
				$marker_html ? $marker_parsed_html : sprintf( '<p>%s</p>', $marker->title ),
				str_repeat( "\t", $tabs_deep+2 )
			);
		}
		$sidebar_html .= sprintf( "%s</ul>\n</div>", str_repeat( "\t", $tabs_deep+1 ), str_repeat( "\t", $tabs_deep ) );
		return $sidebar_html;
	}

	/**
	 * Enable geolocation
	 * This enables HTML5's geolocation
	 * This tests for browser compatibility so as to not cause errors
	 *
	 * @param int $geolocation_timeout Timeout in milliseconds
	 * @param boolean $geolocation_high_accuracy High accuracy flag
	 * @return void
	 */
	public function enableGeolocation( $geolocation_timeout=null, $geolocation_high_accuracy=null ) {
		if ( $geolocation_timeout ) $this->geolocation_timeout = (int) $geolocation_timeout;
		if ( $geolocation_high_accuracy ) $this->geolocation_high_accuracy = (bool) $geolocation_high_accuracy;
		$this->geolocation = true;
	}

	/**
	 * Set the geolocation fail callback
	 *
	 * @param string $callback Function to call if geolocation fails
	 *                         e.g. geofail
	 * @return void
	 */
	public function setGeolocationFailCallback( $callback ) {
		$this->geolocation_fail_callback = $callback;
	}

	/**
	 * Set the geolocation success callback
	 *
	 * @param string $callback Function to call if geolocation succeeds
	 *                         e.g. geosuccess
	 * @return void
	 */
	public function setGeolocationSuccessCallback( $callback ) {
		$this->geolocation_success_callback = $callback;
	}

	/**
	 * Set the map zoom
	 *
	 * @param int $zoom Map zoom
	 * @return void
	 */
	public function setZoom( $zoom ) {
		$this->zoom = abs( (int) $zoom ); 
	}

	/**
	 * Set the map width
	 * e.g. 50x, 100%
	 * 500px is default
	 *
	 * @param string|int $width Width of the map
	 * @return void
	 */
	public function setWidth( $width ) {
		$this->width = sprintf( '%s%s', $width, is_int( $width ) ? 'px' : '' );
	}

	/**
	 * Set the map height
	 * e.g. 500, 100%
	 * 500px is default
	 *
	 * @param string|int $height Height of the map
	 * @return void
	 */
	public function setHeight( $height ) {
		$this->height = sprintf( '%s%s', $height, is_int( $height ) ? 'px' : '' );
	}

	/**
	 * Set the map to metric units
	 *
	 * @return void
	 */
	public function setUnitsMetric() {
		$this->setUnits( 'metric' );
	}

	/**
	 * Set the map to imperial units
	 *
	 * @return void
	 */
	public function setUnitsImperial() {
		$this->setUnits( 'imperial' );
	}

	/**
	 * Set the map units
	 *
	 * @return void
	 * @access private
	 */
	private function setUnits( $units ) {
		$this->units = $units;
	}
	/**
	 * Enable map scrolling
	 *
	 * @return void
	 */
	public function enableScrolling() {
		$this->scrollable = true;
	}

	/**
	 * Disable map scrolling
	 *
	 * @return void
	 */
	public function disableScrolling() {
		$this->scrollable = false;
	}

	/**
	 * Enable map dragging
	 *
	 * @return void
	 */
	public function enableDragging() {
		$this->draggable = true;
	}

	/**
	 * Disable map dragging
	 *
	 * @return void
	 */
	public function disableDragging() {
		$this->draggable = false;
	}

	/**
	 * Enable auto encompass
	 * Enabled by defualt
	 * When markers are present this causes the map to pick an appropriate center
	 * and zoom. Therefore if markers are present on the map a center and zoom do
	 * not need to be set
	 *
	 * @return void
	 */
	public function enableAutoEncompass() {
		$this->auto_encompass = true;
	}

	/**
	 * Disable auto encompass
	 *
	 * @return void
	 */
	public function disableAutoEncompass() {
		$this->auto_encompass = false;
	}

	/**
	 * Enable compressed output
	 * This removed unnecessary spaces from the code to space space
	 *
	 * @return void
	 */
	public function enableCompressedOutput() {
		$this->compress_output = true;
	}

	/**
	 * Disable compressed output
	 * Disbaled is default
	 *
	 * @return void
	 */
	public function disbleCompressedOutput() {
		$this->compress_output = false;
	}

	/**
	 * Set the map type
	 *
	 * @param string $map_type Map type to set
	 * @return void
	 */
	public function setMapType( $map_type ) {
		$this->map_type = $map_type;
	}

	/**
	 * Set the navigation control's style
	 *
	 * @param string $style Navigation control style
	 * @return void
	 */
	public function setNavigationControlStyle( $style ) {
		$this->navigation_control_style = $style;
	}

	/**
	 * Set the map type control's style
	 *
	 * @param string $position Map type control style
	 * @return void
	 */
	public function setMapTypeControlStyle( $style ) {
		$this->map_type_control_style = $style;
	}

	/**
	 * Set the map type control's position
	 *
	 * @param string $position Position of the map type control
	 * @return void
	 */
	public function setMapTypeControlPosition( $position ) {
		$this->map_type_control_position = $position;
	}

	/**
	 * Set the navigation control's position
	 *
	 * @param string $position Position of the navigation control
	 * @return void
	 */
	public function setNavigationControlPosition( $position ) {
		$this->navigation_control_position = $position;
	}

	/**
	 * Set the scale control's position
	 *
	 * @param string $position Position of the scale control
	 * @return void
	 */
	public function setScaleControlPosition( $position ) {
		$this->scale_control_position = $position;
	}

	/**
	 * Enable the scale control
	 *
	 * @return void
	 */
	public function enableScaleControl() {
		$this->scale_control = true;
	}

	/**
	 * Disable the scale control
	 *
	 * @return void
	 */
	public function disableScaleControl() {
		$this->scale_control = true;
	}

	/**
	 * Enable the navigation control
	 *
	 * @return void
	 */
	public function enableNavigationControl() {
		$this->navigation_control = false;
	}

	/**
	 * Disable the navigation control
	 *
	 * @return void
	 */
	public function disableNavigationControl() {
		$this->navigation_control = false;
	}

	/**
	 * Enable the map type control
	 *
	 * @return void
	 */
	public function enableMapTypeControl() {
		$this->map_type_control = false;
	}

	/**
	 * Disable the map type control
	 *
	 * @return void
	 */
	public function disableMapTypeControl() {
		$this->map_type_control = false;
	}

	/**
	 * Add an event listener to the map
	 *
	 * @param DomEventListener $event_listener
	 * @return EventListenerDecorator
	 * @access protected
	 */
	protected function addEventListener( \PHPGoogleMaps\Event\EventListener $event_listener ) {
		return $this->event_listeners[] = new \PHPGoogleMaps\Event\EventListenerDecorator( $event_listener, count( $this->event_listeners ), $this->map_id );
	}

	/**
	 * Set the map language
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Localization
	 * 
	 * @param string $language Language of the map
	 * @return void
	 */
	public function setLanguage( $language ) {
		$this->language = $language;
	}

	/**
	 * Set the API version
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Versioning
	 *
	 * @param string $api_version API version
	 * @return void
	 */
	public function setApiVersion( $api_version ) {
		$this->api_version = (float) $api_version;
	}

	/**
	 * Set the map region
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Localization
	 *
	 * @param string $region Map region
	 * @return void
	 */
	public function setRegion( $region ) {
		$this->region = $region;
	}

	/**
	 * Enable mobile display
	 *
	 * @var boolean $mobile_iphone_fullscreen If you have set the height of the map to 100% and
	 *      $mobile_iphone_fullscreen is true, then the iphone navigation bar will be hidden on page load
	 * @link http://code.google.com/apis/maps/documentation/javascript/basics.html#Mobile
	 *
	 * @return void
	 */
	public function enableMobile( $mobile_iphone_fullscreen=null) {
		$this->mobile = true;
		if ( isset( $mobile_iphone_fullscreen ) ) {
			$this->mobile_iphone_fullscreen = $mobile_iphone_fullscreen;
		}
	}

/*************************************
 *
 * Markers
 *
 **************************************/

	/**
	 * Stagger markers
	 * This will set a small timeout between marker additions
	 *
	 * @param integer $timeout Milliseconds
	 * @return void
	 */
	public function enableMarkerStaggering( $timeout=100 ) {
		$this->stagger_markers = $timeout;
		$this->addObject(
			new \PHPGoogleMaps\Event\EventListener(
			$this,
				'idle',
				sprintf( 'function(){j=0;for(var i=0;i<%1$s.length-1;i++){setTimeout(function(){%1$s[j] = new google.maps.Marker(%1$s[j++])},i*%2$s)};setTimeout(function(){%1$s[%1$s.length-1] = new google.maps.Marker(%1$s[%1$s.length-1])},((%1$s.length-1)*%2$s))}',
					$this->getMarkersJsVar(),
					$this->stagger_markers
				),
				true
			)
		);
	}

	/**
	 * Add a marker to the map
	 *
	 * @param Marker $marker Marker to add
	 * @return MarkerDecorator
	 * @access protected
	 */
	protected function addMarker( \PHPGoogleMaps\Overlay\Marker $marker ) {
		if ( !$marker->getIcon() && $this->default_marker_icon ) {
			$marker->setIcon( $this->default_marker_icon, $this->default_marker_shadow ?: null );
		}
		return $this->markers[] = new \PHPGoogleMaps\Overlay\MarkerDecorator( $marker, count( $this->markers ), $this->map_id );
	}

	

	/**
	 * Get map markers
	 * Returns an array of the map's markers
	 *
	 * @return array
	 */
	public function getMarkers() {
		return $this->markers;
	}

	/**
	 * Set default marker icon
	 * Sets the default icon to be used by the map
	 *
	 * @param MarkerIcon $icon Default marker icon
	 * @param MarkerIcon $shadow Shadow of the default marker icon
	 * @return void
	 */
	public function setDefaultMarkerIcon( \PHPGoogleMaps\Overlay\MarkerIcon $icon, \PHPGoogleMaps\Overlay\MarkerIcon $shadow = null ) {
		$this->default_marker_icon = $icon;
		if ( $shadow ) {
			$this->default_marker_shadow = $shadow;
		}
	}

	/**
	 * Get marker groups
	 * Returns the map's marker groups
	 *
	 * @return array
	 */
	public function getMarkerGroups() {
		$this->extractMarkerData();
		foreach( $this->marker_groups as $mg ) {
			$groups[] = new \PHPGoogleMaps\Overlay\MarkerGroupDecorator( new \PHPGoogleMaps\Overlay\MarkerGroup( $mg['name'] ), $mg['id'], $this->map_id  );
		}
		return $groups;
	}


/**************************************
 *
 * Objects
 *
 **************************************/
 
 	/**
 	 * Add an object to the map
 	 *
 	 * This method calls the various protected add* methods() which
 	 * decorate the objects to allow added functionality
 	 *
 	 * If the objected is already decorated this will strip the
 	 * decoration and redecorate it with the new map's info
 	 *
 	 * @param object $object Object to add to the map
 	 * @return object Returns a decorated object
 	 */
	public function addObject( $object ) {
		if ( !is_object( $object ) ) {
			return false;
		}
		if ( $object instanceof \PHPGoogleMaps\Core\MapObjectDecorator ) {
			$object = $object->decoratee;
		}
		switch( get_class( $object ) ) {
			case 'PHPGoogleMaps\Core\CustomControl':
				$object = $this->addCustomControl( $object );
				break;
			case 'PHPGoogleMaps\Overlay\Marker':
				$object = $this->addMarker( $object );
				break;
			case 'PHPGoogleMaps\Overlay\MapStyle':
				$object = $this->addMapStyle( $object );
				break;
			case 'PHPGoogleMaps\Layer\FusionTable':
				$object = $this->addFusionTable( $object );
				break;
			case 'PHPGoogleMaps\Layer\KmlLayer':
				$object = $this->addKmlLayer( $object );
				break;
			case 'PHPGoogleMaps\Layer\PanoramioLayer':
				$this->libraries[] = 'panoramio';
				$object = $this->addPanoramioLayer( $object );
				break;
			case 'PHPGoogleMaps\Overlay\GroundOverlay':
				$object = $this->addGroundOverlay( $object );
				break;
			case 'PHPGoogleMaps\Event\EventListener':
			case 'PHPGoogleMaps\Event\DomEventListener':
				$object = $this->addEventListener( $object );
				break;
			case 'PHPGoogleMaps\Overlay\Polygon':
			case 'PHPGoogleMaps\Overlay\Polyline':
				$object = $this->addPoly( $object );
				break;
			case 'PHPGoogleMaps\Overlay\Circle':
			case 'PHPGoogleMaps\Overlay\Rectangle':
				$object = $this->addShape( $object );
				break;
			case 'PHPGoogleMaps\Service\WalkingDirections':
			case 'PHPGoogleMaps\Service\BicyclingDirections':
			case 'PHPGoogleMaps\Service\DrivingDirections':
				$object = $this->addDirections( $object );
				break;
			default:
				return false;
		}
		return $object;
	}

	/**
	 * Add an array objects to the map
	 * 
	 * @param array $objects Array of objects to add to the map
	 * @return void
	 */

	public function addObjects( array $objects ) {
		foreach( $objects as $object ) {
			$this->addObject( $object );
		}
	}

	/**
	 * Bind a map object to another
	 *
	 * Example
	 *
	 * $map = new \PHPGoogleMaps\GoogleMap();
	 * $circle = \PHPGoogleMaps\Overlay\Circle::createFromLocation( 'San Diego, CA', 100, $circle_options );
	 * $marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation( 'San Diego, CA', array( 'draggable' => true ) );
	 * $objects = array( &$circle, &$marker );
	 * $map->addObjects( $objects );
	 * $map->bind( $circle, 'center', $marker, 'position' );
	 *
	 * @return void
	 */
	public function bind( \PHPGoogleMaps\Core\MapObjectDecorator $binder, $binder_property, \PHPGoogleMaps\Core\MapObjectDecorator $bindee, $bindee_property  ) {
		$this->binds[] = array(
			'binder'			=> $binder,
			'binder_property'	=> $binder_property,
			'bindee'			=> $bindee,
			'bindee_property'	=> $bindee_property
		);
	}

/******************************************
 *
 * Javascript output
 *
 ******************************************/

	/**
	 * Print the map HTML
	 *
	 * @return void
	 */
	function printMap() {
		echo $this->getMap();
	}

	/**
	 * Get the map HTML
	 *
	 * @return string
	 */
	function getMap() {
		$iphone_safari_hide_navbar = sprintf( "\n<script type=\"text/javascript\">if (navigator.userAgent.indexOf('iPhone') > -1 && navigator.userAgent.indexOf('Safari') > -1){ document.getElementById('%s').style.height = screen.height + 60 + 'px' }</script>", $this->map_id );
		return sprintf( '<div id="%s" style="%s%s">%s</div>%s', $this->map_id, ( $this->width ? 'width:' . $this->width . ';' : '' ), ( $this->height ? 'height:' . $this->height . ';' : '' ), $this->loading_content ? $this->loading_content : '', $this->mobile_iphone_fullscreen ? $iphone_safari_hide_navbar : '' );
	}


	/**
	 * Print the map header javascript
	 *
	 * @return void
	 */
	function printHeaderJS() {
		echo $this->getHeaderJS();
	}

	/**
	 * Get the map header javascript
	 *
	 * @return string
	 */
	function getHeaderJS() {
		$header_js = sprintf(
			"%s<script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=%s&v=%s&language=%s&region=%s&libraries=%s\"></script>\n\n",
			( $this->mobile ? "<meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\">\n" : '' ),
			json_encode( $this->sensor ),
			$this->api_version,
			$this->language,
			$this->region,
			( count( $this->libraries ) ? sprintf( implode( ',', $this->libraries ) ) : '' )
		);
		if ( $this->clustering_js ) {
			$header_js .= sprintf( "\n<script type=\"text/javascript\" src=\"%s\"></script>", $this->clustering_js );
		}
		return $header_js;
	}

	/**
	 * Print the map javascript
	 *
	 * @return void
	 */
	function printMapJS() {
		echo $this->getMapJS();
	}

	/**
	 * Get the map javascript
	 *
	 * @return string
	 */
	function getMapJS() {

		$output = sprintf( "var %s;\nfunction phpgooglemap_%s() {\n\nthis.initialize = function() {\n\n", $this->map_id, $this->map_id );
		$output .= "\tvar self = this;\n";
	  	$output .= "\tthis.map_options = {\n";
  		$output .= sprintf("\t\tzoom: %s,\n", $this->zoom );

	  	if ( !$this->scrollable ) {
	  		$output .= "\t\tscrollwheel: false,\n";
	  	}
	  	if ( !$this->streetview ) {
	  		$output .= "\t\tstreetViewControl: false,\n";
	  	}
	  	if ( !$this->draggable ) {
	  		$output .= "\t\tdraggable: false,\n";
	  	}

		$output .= sprintf( "\t\tnavigationControl: %s,\n", $this->phpToJs( $this->navigation_control ) );
		$output .= sprintf( "\t\tmapTypeControl: %s,\n", $this->phpToJs( $this->map_type_control ) );
		$output .= sprintf( "\t\tscaleControl: %s,\n", $this->phpToJs( $this->scale_control ) );

		$output .= "\t\tnavigationControlOptions: {\n";
		if ( $this->navigation_control_style ) {
  			$output .= sprintf( "\t\t\tstyle: google.maps.NavigationControlStyle.%s,\n", strtoupper( $this->navigation_control_style ) );
		}
		if ( $this->navigation_control_position ) {
  			$output .= sprintf( "\t\t\tposition: google.maps.ControlPosition.%s,\n", strtoupper( $this->navigation_control_position ) );
		}
		$output .= "\t\t},\n";

		$output .= "\t\tmapTypeControlOptions: {\n";
		if ( $this->map_type_control_style ) {
  			$output .= sprintf( "\t\t\tstyle: google.maps.MapTypeControlStyle.%s,\n", strtoupper( $this->map_type_control_style ) );
		}
		if ( $this->map_type_control_position ) {
  			$output .= sprintf( "\t\t\tposition: google.maps.ControlPosition.%s,\n", strtoupper( $this->map_type_control_position ) );
		}
		if ( count( $this->map_types ) ) {
			$map_types_string = '';
			foreach( $this->map_types as $map_type ) {
				if ( isset( $this->map_styles[$map_type] ) ) {
					$map_types_string .= sprintf( "'%s',", $this->map_styles[$map_type]->var_name );
				}
				else {
					$map_types_string .= sprintf( "google.maps.MapTypeId.%s,", strtoupper( $map_type ) );
				}
			}
			$output .= sprintf( "\t\t\tmapTypeIds: [%s],\n", rtrim( $map_types_string, ',' ) );
		}
		$output .= "\t\t},\n";
		$output .= "\t\tscaleControlOptions: {\n";
		if ( $this->scale_control_position ) {
  			$output .= sprintf( "\t\t\tposition: google.maps.ControlPosition.%s,\n", strtoupper( $this->scale_control_position ) );
		}
		$output .= "\t\t},\n";

	    $output .= sprintf("\t\tmapTypeId: google.maps.MapTypeId.%s,\n", strtoupper( $this->map_type ) );
	  	$output .= "\t};\n\n";
	  	$output .= sprintf( "\tthis.map = new google.maps.Map(document.getElementById(\"%s\"), this.map_options);\n", $this->map_id );

		foreach( $this->map_styles as $map_style ) {
			$output .= sprintf( "\t%sMapStyle = %s;\n", $map_style->var_name, $map_style->style );
			$output .= sprintf( "\t%sStyleOptions = { name: \"%s\"};\n", $map_style->var_name, $map_style->name );
			$output .= sprintf( "\t%sMapType = new google.maps.StyledMapType(%sMapStyle, %sStyleOptions);\n", $map_style->var_name, $map_style->var_name, $map_style->var_name );
			$output .= sprintf( "\tthis.map.mapTypes.set('%s', %sMapType);\n", $map_style->var_name, $map_style->var_name );
		}

		if ( count( $this->custom_controls ) ) {
			$output .= "\n\tthis.custom_controls = [];\n";
			foreach( $this->custom_controls as $n => $custom_control ) {
				$output .= sprintf( "\tvar cc%s_outer = document.createElement('DIV');\n", $n );
				foreach( $custom_control->options['outer'] as $var => $val ) {
					$output .= sprintf( "\tcc%s_outer.%s = '%s';\n", $n, $var, $val );
				}
				$output .= sprintf( "\tvar cc%s_inner = document.createElement('DIV');\n", $n );
				foreach( $custom_control->options['inner'] as $var => $val ) {
					$output .= sprintf( "\tcc%s_inner.%s = '%s';\n", $n, $var, $val );
				}
				$output .= sprintf( "\tcc%s_outer.appendChild(cc%s_inner);\n", $n, $n );
				$output .= sprintf( "\tvar cc%s_holder = document.createElement('DIV');\n", $n );
				$output .= sprintf( "\tcc%s_holder.appendChild(cc%s_outer);\n", $n, $n );
				$output .= sprintf( "\tthis.map.controls[google.maps.ControlPosition.%s].push(cc%s_holder);\n", $custom_control->position, $n );
				$output .= sprintf( "\tthis.custom_controls[%s] = cc%s_holder;\n\n", $n, $n );
				foreach( $custom_control->listeners as $listener ) {
					  $output .= sprintf( "\tgoogle.maps.event.addDomListener(cc%s_holder, '%s', %s);\n\n", $n, $listener['event'], $listener['function'] );
				}
			}
		}


		if ( count( $this->shapes ) ) {
			$output .= sprintf( "\n\tthis.shapes = [];\n", $this->map_id );
			foreach( $this->shapes as $n => $shape ) {
				if ( $shape->decoratee instanceof \PHPGoogleMaps\Overlay\Circle ) {
		  			$output .= sprintf( "\tthis.shapes[%s] = new google.maps.Circle( {\n", $n );
					$output .= sprintf( "\t\tcenter: new google.maps.LatLng(%s,%s),\n", $shape->center->getLat(), $shape->center->getLng() );
					$output .= sprintf( "\t\tradius: %s,\n", $shape->radius );
				}
				elseif ( $shape->decoratee instanceof \PHPGoogleMaps\Overlay\Rectangle ) {
		  			$output .= sprintf( "\tthis.shapes[%s] = new google.maps.Rectangle( {\n", $n );
					$output .= sprintf( "\t\tbounds: new google.maps.LatLngBounds(new google.maps.LatLng(%s,%s),new google.maps.LatLng(%s,%s)),\n",
										$shape->southwest->getLat(),
										$shape->southwest->getLng(),
										$shape->northeast->getLat(),
										$shape->northeast->getLng()
									);
				}
				foreach( $shape->getOptions() as $var => $val ) {
					$output .= sprintf( "\t\t%s: %s,\n", $var, $this->phpToJs( $val ) );
				} 
					$output .= sprintf( "\t\tmap: this.map\n" );
					$output .= "\t} );\n";
			}
		}

		if ( count( $this->polys ) ) {
			$output .= sprintf( "\n\tthis.polys = [];\n", $this->map_id );
			foreach( $this->polys as $n => $poly ) {
				if ( $poly->decoratee instanceof \PHPGoogleMaps\Overlay\Polygon ) {
		  			$output .= sprintf( "\tthis.polys[%s] = new google.maps.Polygon( {\n", $n );
					foreach( $poly->getOptions() as $var => $val ) {
						$output .= sprintf( "\t\t%s: %s,\n", $var, $this->phpToJs( $val ) );
					}
					$output .= sprintf( "\t\tpaths: %s,\n", $this->parseLatLngs( $this->phpToJs( $poly->getPaths() ) ) );
					$output .= sprintf( "\t\tmap: this.map\n" );
					$output .= "\t} );\n";
				}
				elseif ( $poly->decoratee instanceof \PHPGoogleMaps\Overlay\Polyline ) {
		  			$output .= sprintf( "\tthis.polys[%s] = new google.maps.Polyline( {\n", $n );
					foreach( $poly->getOptions() as $var => $val ) {
						$output .= sprintf( "\t\t%s: %s,\n", $var, $this->phpToJs( $val ) );
					}
					$output .= sprintf( "\t\tpath: %s,\n", $this->parseLatLngs( $this->phpToJs( $poly->getPaths() ) ) );
					$output .= sprintf( "\t\tmap: this.map\n" );
					$output .= "\t} );\n";
				}
			}
		}

	  	if ( $this->directions ) {
			$output .= "\tthis.directions = {};\n";
		  	$renderer_options = "\tthis.directions.renderer_options = {\n";
		  	foreach ( $this->directions->renderer_options as $renderer_option => $renderer_value ) {
		  		switch ( $renderer_option ) {
		  			case 'panel':
		  				$renderer_options .= sprintf( "\t\tpanel: document.getElementById(\"%s\"),\n", $renderer_value );
		  				break;
		  			default:
		  				$renderer_options .= sprintf( "\t\t%s:%s,\n", $renderer_option, $this->phpToJs( $renderer_value ) );
		  		}
		  	}
		  	$renderer_options .= "\t};\n\n";
	  		$output .= $renderer_options;
	  	
			$output .= "\tthis.directions.renderer = new google.maps.DirectionsRenderer(this.directions.renderer_options);\n\tthis.directions.service = new google.maps.DirectionsService();\n";
		  	$output .= "\tthis.directions.renderer.setMap(this.map);\n\n";
		  	
		  	$request_options = sprintf( "\tthis.directions.request_options = {\n", $this->map_id );
			if ( isset( $this->units ) && !isset( $this->directions->request_options['units'] ) ) {
		  		$this->directions->request_options['units'] = $this->units;
		  	}
		  	foreach ( $this->directions->request_options as $request_option => $request_value ) {
		  		switch ( $request_option ) {
		  			case 'waypoints':
		  				$request_options .= sprintf("\t\twaypoints: %s,\n", $this->parseLatLngs( $this->phptoJs( $request_value ) ) );
		  				break;
		  			case 'origin':
				  		$request_options .= sprintf( "\t\torigin: new google.maps.LatLng(%s,%s),\n", $this->directions->request_options['origin']->getLat(), $this->directions->request_options['origin']->getLng() );
					  	break;
					case 'destination':
				  		$request_options .= sprintf( "\t\tdestination: new google.maps.LatLng(%s,%s),\n", $this->directions->request_options['destination']->getLat(), $this->directions->request_options['destination']->getLng() );
					  	break;
					case 'travelMode':
					  	$request_options .= sprintf( "\t\ttravelMode: google.maps.DirectionsTravelMode.%s,\n", strtoupper( $this->directions->request_options['travelMode'] ) );
					  	break;
					case 'units':
					  	$request_options .= sprintf( "\t\tunitSystem: google.maps.DirectionsUnitSystem.%s,\n", isset( $this->directions->request_options['units'] ) ?: $this->units );
						break;
		  			default:
		  				$request_options .= sprintf( "\t\t%s:%s,\n", $request_option, $this->phpToJs( $request_value ) );
		  		}
		  	}
			$request_options .= "\t};\n";
			$output .= $request_options;
		  	$output .= "\t\n\tthis.directions.service.route(this.directions.request_options, function(response,status) {\n\t\tif (status == google.maps.DirectionsStatus.OK) {\n\t\t\tself.directions.success = response;\n\t\t\tself.directions.renderer.setDirections(response);\n\t\t}\n\t\telse {\n\t\t\tself.directions.error = status;\n\t\t}\n\t});\n\n";
		}

		if ( count( $this->marker_shapes ) ) {
			$output .= sprintf( "\n\tthis.marker_shapes = [];\n", $this->map_id );
		  	foreach ( $this->marker_shapes as $marker_shape ) {
	  			$output .= sprintf( "\tthis.marker_shapes[%s] = {\n", $marker_shape->id );
				$output .= sprintf( "\t\ttype: \"%s\",\n", $marker_shape->type );
				$output .= sprintf( "\t\tcoord: [%s]\n", implode( ",", $marker_shape->coords ) );
				$output .= "\t};\n";
		  	}
	  	}

		$this->extractMarkerData();

		if ( count( $this->marker_icons ) ) {
			$output .= sprintf( "\n\tthis.marker_icons = [];\n", $this->map_id );
		  	foreach ( $this->marker_icons as $marker_icon_id => $marker_icon ) {
	  			$output .= sprintf( "\tthis.marker_icons[%s] = new google.maps.MarkerImage(\n\t\t\"%s\",\n", $marker_icon_id, $marker_icon->icon );
				$output .= sprintf( "\t\tnew google.maps.Size(%s, %s),\n", $marker_icon->width, $marker_icon->height );
				$output .= sprintf( "\t\tnew google.maps.Point(%s, %s),\n", (int)$marker_icon->origin_x, (int)$marker_icon->origin_y );
				$output .= sprintf( "\t\tnew google.maps.Point(%s, %s)\n", (int)$marker_icon->anchor_x, (int)$marker_icon->anchor_y );
				$output .= "\t);\n";
		  	}
	  	}

	  	if ( count( $this->markers ) && $this->auto_encompass ) {
			$output .= "\n\tthis.bounds = new google.maps.LatLngBounds();\n";
	  	}

		if ( $this->info_windows ) {
			$output .= "\tthis.info_window = new google.maps.InfoWindow();\n";
	  	}

		if ( count( $this->marker_shapes ) ) {
			$output .= sprintf( "\n\tthis.marker_shapes = [];\n", $this->map_id );
		  	foreach ( $this->marker_shapes as $shape_id => $marker_shape ) {
	  			$output .= sprintf( "\tthis.marker_shapes[%s] = {\n", $shape_id );
				$output .= sprintf( "\t\ttype: \"%s\",\n", $marker_shape->type );
				$output .= sprintf( "\t\tcoord: [%s]\n", implode( ",", $marker_shape->coords ) );
				$output .= "\t};\n";
		  	}
	  	}

		if ( count( $this->marker_groups ) ) {
			$output .= "\n\tthis.marker_groups = [];\n";
			$output .= "\tthis.marker_group_function = function( group_name, f_all, f_group ) {\n\t\tfor (i in map.markers) {\n\t\t\tvar marker = map.markers[i];\n\t\t\tf_all(marker);\n\t\t}\n\t\tfor (i in map.marker_groups[group_name].markers) {\n\t\t\tvar marker = map.markers[map.marker_groups[group_name].markers[i]];\n\t\t\tf_group(marker);\n\t\t}\n\t};\n";
			foreach( $this->marker_groups as $marker_group_var => $marker_group ) {
				$output .= sprintf( "\tthis.marker_groups[\"%s\"] = {name: \"%s\", markers:[%s]};\n", $marker_group_var, $marker_group['name'], implode( ',', $marker_group['markers'] ) );
			}
	  	}

		if ( count( $this->markers ) ) {
			$output .= "\n\tthis.markers = [];\n";
	  	}
	  	foreach ( $this->getMarkers() as $marker_id => $marker ) {
	  		if ( $marker->isGeolocated() ) {
	  			if ( !$this->geolocation ) {
		  			$this->enableGeolocation( $marker->geolocation_timeout, $marker->geolocation_high_accuracy );
	  			}
	  			$output .= "\tif ( navigator.geolocation && typeof geolocation != 'undefined' ) {\n";
	  		}
	  		if ( $this->stagger_markers ) {
				$output .= sprintf( "\tthis.markers[%s] = {\n", $marker_id );
			}
			else {
				$output .= sprintf( "\tthis.markers[%s] = new google.maps.Marker({\n", $marker_id );
			}
			if ( $marker->geolocation ) {
				$output .= "\t\tposition: geolocation,\n";
			}
			else {
				$output .= sprintf( "\t\tposition: new google.maps.LatLng(%s,%s),\n", $marker->position->getLat(), $marker->position->getLng() );			
			}
			if ( !$this->clustering_js  ) {
				$output .= "\t\tmap: this.map,\n";
			}
			if ( is_int( $marker->_icon_id ) ) {
				$output .= sprintf( "\t\ticon:this.marker_icons[%s],\n", $marker->_icon_id );
			}
			if ( is_int( $marker->_shadow_id ) ) {
				$output .= sprintf( "\t\tshadow:this.marker_icons[%s],\n", $marker->_shadow_id );
			}
			if ( is_int( $marker->_shape_id ) ) {
				$output .= sprintf( "\t\tshape:this.marker_shapes[%s],\n", $marker->_shape_id );
			}
			if ( count( $marker->groups ) ) {
				$gs = $this->marker_groups;
				$output .= sprintf( "\t\tgroups:[%s],\n", implode( ',', array_map( function( $g ) use ( $gs ) { return $gs[$g->var_name]['id']; }, $marker->groups ) ) );
			}
			if ( $marker->animation ) {
				$output .= sprintf( "\t\tanimation: google.maps.Animation.%s,\n", strtoupper( $marker->animation ) );
				$marker->removeOption( 'animation' );
			}
			foreach( $marker->getOptions() as $marker_option => $marker_value ) {
				$output .= sprintf( "\t\t%s:%s,\n", $marker_option, $this->phpToJs( $marker_value ) );
			}
			
			$output .= sprintf( "\t}%s;\n", $this->stagger_markers ? '' : ')');

			if ( $this->info_windows ) {
				if ( isset( $marker->content ) ) {
					$output .= sprintf( "\tgoogle.maps.event.addListener(this.markers[%s], 'click', function() { if ( !self.markers[%s].getVisible() ) return; self.info_window.setContent(self.markers[%s].content);self.info_window.open(self.map,self.markers[%s]); });\n", $marker_id, $marker_id, $marker_id, $marker_id );
				}
			}

	  		if ( $this->auto_encompass & !isset( $marker->location ) ) {
				$output .= sprintf( "\tthis.bounds.extend(this.markers[%s].position);\n", $marker_id );
				$output .= "\tthis.map.fitBounds(this.bounds);\n";
			}

	  		if ( $marker->geolocation ) {
	  			$output .= "\t}\n\n";
	  		}

	  	}
	  	if ( $this->clustering_js ) {
			$output .= sprintf( "\n\tvar markerCluster = new MarkerClusterer(this.map, this.markers, %s);\n", $this->phpToJs( $this->clustering_options ) );
		}
		if ( count( $this->ground_overlays ) ) {
			$output .= "\tthis.ground_overlays = [];\n";
			foreach( $this->ground_overlays as $n => $ground_overlay ) {
		  		$output .= sprintf( "\tthis.ground_overlays[%s] = new google.maps.GroundOverlay('%s', new google.maps.LatLngBounds(new google.maps.LatLng(%s,%s),new google.maps.LatLng(%s,%s)), %s);\n\tthis.ground_overlays[%s].setMap(this.map);\n\n",
			  		$n,
			  		$ground_overlay->url,
					$ground_overlay->southwest->getLat(),
					$ground_overlay->southwest->getLng(),
					$ground_overlay->northeast->getLat(),
					$ground_overlay->northeast->getLng(),
			  		$this->phpToJs( $ground_overlay->options ),
			  		$n
		  		);
			}
		}

		if ( count( $this->kml_layers ) ) {
			$output .= "\tthis.kml_layers = [];\n";
			foreach( $this->kml_layers as $n => $kml_layer ) {
				$output .= sprintf( "\tthis.kml_layers[%s] = new google.maps.KmlLayer('%s', %s);\n\tthis.kml_layers[%s].setMap(this.map);\n\n", $n, $kml_layer->url, $this->phpToJs( $kml_layer->options ), $n );
			}
		}

		if ( count( $this->panoramio_layers ) ) {
			$output .= "\tthis.panoramio_layers = [];\n";
			foreach( $this->panoramio_layers as $n => $panoramio_layer ) {
				$output .= sprintf( "\tthis.panoramio_layers[%s] = new google.maps.panoramio.PanoramioLayer();\n\tthis.panoramio_layers[%s].setMap(this.map);\n", $n, $n );
				if ( $p_tag = $panoramio_layer->getOption('tag') ) {
					$output .= sprintf( "\tthis.panoramio_layers[%s].setTag('%s');\n", $n, $p_tag );
				}
				if ( $p_user_id = $panoramio_layer->getOption('user_id') ) {
					$output .= sprintf( "\tthis.panoramio_layers[%s].setUserId('%s');\n", $n, $p_user_id );
				}
				$output .= "\n";
			}
		}

		if ( count( $this->fusion_tables ) ) {
			$output .= "\tthis.fusion_tables = [];\n";
		  	foreach ( $this->fusion_tables as $n => $fusion_table ) {
				$ft_options = '';
				foreach( $fusion_table->getOptions() as $var => $val ) {
					if ( $var == 'query' ) {
						$val = $this->switchQuotes( $val );
					}
					$ft_options .= sprintf( "\t\t%s: %s,\n", $this->phpToJs( $var ), $this->phpToJs( $val ) );
				}
		  		$output .= sprintf( "\tthis.fusion_tables[%s] = new google.maps.FusionTablesLayer(%s, {\n%s\t});\n\tthis.fusion_tables[%s].setMap(this.map);\n\n", $n, $fusion_table->table_id, $ft_options, $n );
		  	}
		}

	  	if ( count( $this->binds ) ) {
	  		foreach( $this->binds as $bind ) {
	  			$output .= sprintf( "\t%s.bindTo('%s', %s, '%s');\n", $bind['bindee']->getJsVar(), $bind['bindee_property'], $bind['binder']->getJsVar(), $bind['binder_property'] );
	  		}
	  	}
	  	
	  	if ( $this->adsense ) {
	  		$output .= sprintf(
	  			"\tadsense_options = {\n\t\tformat: google.maps.adsense.AdFormat.%s,\n\t\tposition: google.maps.ControlPosition.%s,\n\t\tmap: this.map,\n\t\tvisible: %s,\n\t\tpublisherId: '%s'\n\t}\n\tad_unit = new google.maps.adsense.AdUnit(document.createElement('div'), adsense_options);\n\n", 
				strtoupper( $this->adsense_format ),
				strtoupper( $this->adsense_position ),
				$this->phpToJs( $this->adsense_visible ),
				$this->adsense_publisher_id
			);
	  	}
	  	
	  	if ( $this->traffic_layer ) {
	  		$output .= "\tthis.traffic_layer = new google.maps.TrafficLayer();\n\tthis.traffic_layer.setMap(this.map);\n\n";
	  	}

	  	if ( $this->bicycle_layer ) {
	  		$output .= "\tthis.bicycle_layer = new google.maps.BicyclingLayer();\n\tthis.bicycle_layer.setMap(this.map);\n\n";
	  	}

		if ( $this->center_on_user ) {
			if ( $this->geolocation_backup ) {
				$output .= "\tif ( typeof geolocation != 'undefined' ) {\n";
			}
			$output .= "\t\tthis.map.setCenter( geolocation );\n";
			if ( $this->geolocation_backup ) {
				$output .= sprintf( "\t}\n\telse {\n\t\tthis.map.setCenter( new google.maps.LatLng(%s,%s) );\n\t}\n\n", $this->geolocation_backup->getLat(), $this->geolocation_backup->getLng() );
			}
		}
	  	if ( $this->center ) {
			$output .= sprintf( "\tthis.map.setCenter( new google.maps.LatLng(%s,%s) );\n", $this->center->getLat(), $this->center->getLng() );
		}
	  	
	  	if ( count ($this->event_listeners ) ) {
			$output .= "\tthis.event_listeners = [];\n";
	  		foreach( $this->event_listeners as $n => $event_listener ) {
	  			$event_class = get_class( $event_listener->decoratee );
		  		$output .= sprintf( "\tthis.event_listeners[%s] = google.maps.event.add%sListener%s(%s, '%s', %s);\n",
		  						$n,
		  						$event_class == 'PHPGoogleMaps\Event\DomEventListener' ? 'Dom' : '',
		  						$event_listener->once ? 'Once' : '',
		  						$event_listener->object instanceof \PHPGoogleMaps\Core\MapObjectDecorator || $event_listener->object instanceof \PHPGoogleMaps\Map ? $event_listener->object : sprintf( 'document.getElementById("%s")', $event_listener->object ),
		  						$event_listener->event,
		  						$event_listener->function
		  					);
		  	}
	  	}

	  	if ( $this->streetview ) {
	  		$streetview_options = '';
			if ( isset ( $this->streetview->options ) ) {
	  			foreach( $this->streetview->options as $streetview_option => $streetview_value ) {
	  				switch( $streetview_option ) {
	  					case 'container':
	  						break;
	  					default:
			  				$streetview_options .= sprintf( "\t\t%s:%s,\n", $streetview_option,  $this->parseLatLngs( $this->phpToJs( $streetview_value ) ) );
					}
	  			}
			}
	  		$output .= sprintf( "\tthis.streetview = new google.maps.StreetViewPanorama(document.getElementById(\"%s\"), {\n%s\t});\n\tthis.map.setStreetView(this.streetview);\n", $this->streetview->container, $streetview_options );

	  	}
		

	  	$output .= sprintf( "\n};\n\n}\nfunction initialize_%s() {\n\t%s = new phpgooglemap_%s();\n\t%s.initialize();\n\n%s\n\n}\n\n", $this->map_id, $this->map_id, $this->map_id, $this->map_id, $this->mobile_iphone_fullscreen ? 'setTimeout(function() { window.scrollTo(0, 1) }, 100);' : '' );

		if ( $this->geolocation ) {
			$output .= "function get_geolocation() {\n";
			$output .= sprintf( "\tnavigator.geolocation.getCurrentPosition( geolocation_success_init, geolocation_error_init, {enableHighAccuracy: %s, timeout: %s} );\n", ( $this->geolocation_high_accuracy ? 'true' : 'false' ), $this->geolocation_timeout);
			$output .= "}\n";
			$output .= "function geolocation_success_init( position ) {\n";
			$output .= sprintf( "\tgeolocation_status=1;\n\tgeolocation_lat = position.coords.latitude;\n\tgeolocation_lng = position.coords.longitude;\n\tgeolocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);%s\n\tinitialize_%s();\n}\n", ( $this->geolocation_success_callback ? "\n\t" . $this->geolocation_success_callback . "();" : '' ),$this->map_id );
			$output .= sprintf( "function geolocation_error_init( error ){\n\tgeolocation_status=0;\n\tgeolocation_error = error.code;%s\n\tinitialize_%s();\n}\n", ( $this->geolocation_fail_callback ? "\n\t" . $this->geolocation_fail_callback . "();" : '' ), $this->map_id );
			$output .= "if ( navigator.geolocation ) {\n";
  			$output .= "\tgoogle.maps.event.addDomListener(window, \"load\", get_geolocation );\n";
  			$output .= "}\nelse {\n";
  			$output .= sprintf( "\tgeolocation_status = 0;\n\tgeolocation_error = -1;\n\tgoogle.maps.event.addDomListener(window, \"load\", initialize_%s );\n}\n\n", $this->map_id, $this->map_id );
		}
		else {
  			$output .= sprintf( "google.maps.event.addDomListener(window, \"load\", initialize_%s );\n\n", $this->map_id, $this->map_id );
		}

		if ( $this->compress_output ) {
			$output = preg_replace( '~\n|\t~', '', $output );
			$output = preg_replace( '~\s*([:=\(\)\{\},])\s*~', "$1", $output );
		}

		$output = preg_replace( '~,(\s*[\}|\)])~', '$1', $output );

		return sprintf("\n<script type=\"text/javascript\">\n\n%s\n\n</script>", $output );
	
	}

	/**************************************
	*
	* Code output functions
	*
	****************************************/

	/**
	 * Convert PHP to JSON
	 *
	 * @param string $php PHP code
	 * @return string Returns JSON code
	 */
	private function phpToJs( $php ) {
		if ( is_null( $php ) ) {
			return '{}';
		}
		return json_encode( $php );
	}

	/**
	 * Switch quotes from " to ' for output into javascript code
	 *
	 * @param $str String to switch quotes
	 * @return string Returns the string with the quotes switched
	 */
	private function switchquotes( $str ) {
		return str_replace( '"', "'", $str );
	}

	/**
	 * Parse LatLngs in a string
	 *
	 * @param string $str String to replace
	 * @return string Returns the string with LatLngs replaced with
	 *                google LatLng objects
	 * @access private
	 */
	private function parseLatLngs( $str ) {
		return preg_replace( '~{"lat":(.*?),"lng":(.*?),.*?}~i', 'new google.maps.LatLng($1,$2)', $str );
	}

	/**
	 * Normalize a variable name
	 * Removes all non-word characters from a variable name
	 *
	 * @param string $var Variable to normalize
	 * @return string Returns the normalized variable
	 * @access private
	 */
	private function normalizeVariable( $var ) {
		return preg_replace( '~\W~', '', $var );
	} 

	/**
	 * Get the map's javascript variable
	 *
	 * @return string
	 */
	public function getJsVar() {
		return sprintf( '%s.map', $this->map_id );
	}

	/*
	 * toString magic method
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getJsVar();
	}

	/**
	 * Get the map's javascript variable
	 *
	 * @return string
	 */
	public function getMarkersJsVar() {
		return sprintf( '%s.markers', $this->map_id );
	}

	/**
	 * Get info window's javascript variable
	 *
	 * @return string
	 */
	public function getInfoWindowJsVar() {
		return $this->info_windows ? sprintf( '%s.info_window', $this->map_id ) : 'null';
	}

	/**
	 * Extract marker data
	 * This gets called to extract the icons and groups from the markers
	 * and organize them
	 *
	 * @return void
	 * @access private
	 */
	private function extractMarkerData() {

		$hash = md5( serialize( $this->getMarkers() ) );

		if ( $hash == $this->marker_data_hash ) {
			return true;
		}

	  	foreach( $this->markers as $marker_id => $marker ) {
			if ( $marker->icon instanceof \PHPGoogleMaps\Overlay\MarkerIcon ) {
				if ( ( $icon_id = array_search( $marker->icon, $this->marker_icons ) ) !== false ) {
		  			$marker->_icon_id = $icon_id;
	  			}
	  			else {
		  			$this->marker_icons[] = $marker->icon;
		  			$marker->_icon_id = count( $this->marker_icons ) - 1;
	  			}
				if ( $marker->shadow instanceof \PHPGoogleMaps\Overlay\MarkerIcon ) {
					if ( ( $shadow_id = array_search( $marker->shadow, $this->marker_icons ) ) !== false ) {
		  				$marker->_shadow_id = count( $this->marker_icons ) - 1;
		  			}
		  			else {
			  			$this->marker_icons[] = $marker->shadow;
						$marker->_shadow_id = count( $this->marker_icons ) - 1;
		  			}
				}
			}
  			if ( $marker->shape instanceof \PHPGoogleMaps\Overlay\MarkerShape ) {
				if ( ( $shape_id = array_search( $marker->shape, $this->marker_shapes ) ) !== false ) {
					$marker->_shape_id = $shape_id;
	  			}
	  			else {
		  			$this->marker_shapes[] = $marker->shape;
					$marker->_shape_id = count( $this->marker_shapes ) - 1;
	  			}
  			}
  			foreach ( $marker->groups as $marker_group ) {
  				if ( isset( $this->marker_groups[ $marker_group->var_name ] ) ) {
  					$this->marker_groups[ $marker_group->var_name ]['markers'][] = $marker_id;
  				}
  				else {
  					$this->marker_groups[ $marker_group->var_name ] = array(
  						'id'		=> count( $this->marker_groups ),
  						'name'		=> $marker_group->name,
  						'markers'	=> array( $marker_id )
  					);
  				}
			}
	  	}
	  	$this->marker_data_hash = md5( serialize( $this->getMarkers() ) );

	}

 	/**
 	 * Enable Adsense ads
 	 *
 	 * Format and position must be valid or the map will not display
 	 * @link http://code.google.com/apis/maps/documentation/javascript/advertising.html
 	 *
 	 * @param string $publisher_id Your adsense publisher id
 	 * @param string $format A valid adsense ad format {@link http://code.google.com/apis/maps/documentation/javascript/advertising.html#AdUnitFormats}
 	 * @param string $position A valid control position {@link http://code.google.com/apis/maps/documentation/javascript/reference.html#ControlPosition}
	 * @param boolean $visible
 	 * @return object Returns a decorated object
 	 */
	function enableAdsense( $publisher_id, $format = null, $position = null, $visible = null ) {
		$this->libraries[] = 'adsense';
		$this->adsense = true;
		$this->adsense_publisher_id = $publisher_id;
		if ( $format ) $this->adsense_format = $format;
		if ( $position ) $this->adsense_position = $position;
		$this->adsense_visible = $visible;
	}

	function enableClustering( $clustering_js_file, $options = null ) {
		$this->clustering_js = $clustering_js_file;
		$this->clustering_options = $options;
	}

}