<?php

/**
 * Google Maps
 * PHP Wrapper for Google Maps v3
 * @author Galen Grover <galenjr@gmail.com>
 * @package GoogleMaps
*/


namespace googlemaps;

/**
 * Google Map
 *
 * The main class that controls the output of a map
 * All map objects must be added to an instance of GoogleMap via addObject() or addObjects()
 *
 */

class GoogleMap {

	/**
	 * Map ID
	 *
	 * ID of the map. This will be used for CSS and javascript.
	 * 
	 * @var string
	 */
	private $map_id = 'map';

	/**
	 * Map ID
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
	 * Map shapes
	 * Array of shapes added to the map
	 *
	 * @var array
	 */
	private $shapes = array();

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
	 * Map markers
	 * All the map markers
	 *
	 * @var array
	 */
	private $markers = array();

	/**
	 * Hash of the marker data
	 * This is used to keep form extracting the same marker data
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
	 *
	 * Array of fusion tables added to the map
	 * 
	 * @var array
	 */
	private $fusion_tables = array();

	/**
	 * KML layers
	 *
	 * Array of KML layers added to the map
	 * 
	 * @var array
	 */
	private $kml_layers = array();

	/**
	 * Traffic flag
	 *
	 * Display traffic layer
	 * 
	 * @var boolean
	 */
	private $traffic_layer = false;

	/**
	 * Streetview
	 *
	 * Streetview object
	 * 
	 * @var boolean
	 */
	private $streetview;

	/**
	 * Bicycle flag
	 *
	 * Display bicycle layer
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
	 * Controls the displaying of info windows
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
	 * Attempt geolocation on the user
	 * This will check the browser for geolocation capabilities to avoid errors
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
	 * Geolocation fail function
	 * Function to call if geolocation fails
	 *
	 * @var string
	 */
	private $geolocation_fail_function;

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
	 * Map Directions
	 *
	 * @var Directions
	 */
	private $directions;
	
	/**
	 * Directions fail callback
	 * Function to call if directions fail to load
	 *
	 * @var string
	 */
	private $directions_fail_callback;

	/**
	 * Directions success callback
	 * Function to call if directions succeed to load
	 *
	 * @var string
	 */
	private $directions_success_callback;

	/**
	 * Constructor
	 *
	 * @var string $map_id ID to give the map
	 * @return GoogleMap
	 */
	public function __construct( $map_id = null ) {
		if ( $map_id ) {
			$this->map_id  = preg_match( '\W', '', $map_id );
		}
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
	public function addDirections( \googlemaps\overlay\Directions $dir ) {
		return $this->directions = new \googlemaps\overlay\DirectionsDecorator( $dir, $this->map_id );
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
	 * Add a fusion table to the map
	 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#FusionTablesLayer
	 * @link http://tables.googlelabs.com/
	 *
	 * @param FusionTable $ft Fusion table to add to the map
	 * @return FusionTableDecorator
	 * @access protected
	 */
	protected function addFusionTable( \googlemaps\layer\FusionTable $ft ) {
		$ft = new \googlemaps\layer\FusionTableDecorator( $ft, count( $this->fusion_tables ), $this->map_id );
		return $this->fusion_tables[] = $ft;
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
	protected function addKmlLayer( \googlemaps\layer\KmlLayer $kml ) {
		$this->kml_layers[] = $kml;
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
	protected function addShape( \googlemaps\overlay\Shape $shape ) {
		$this->shapes[] = new \googlemaps\overlay\ShapeDecorator( $shape, count( $this->shapes ), $this->map_id );
	}

	/**
	 * Get the array of the map's shapes
	 *
	 * @return array
	 */
	public function getShapes() {
		return $this->shapes;
	}

/************************************************
 * 
 * Map Options
 *
 ************************************************/

	public function setCenter( \googlemaps\core\LatLng $latlng ) {
		$this->center = $latlng;
	}
	
	public function setCenterByLocation( $location ) {
		$result = \googlemaps\service\Geocoder::getLatLng( $location );
		if ( $result instanceof \googlemaps\core\LatLng ) {
			$this->setCenter( $result );
		}
		return $result;
	}

	public function setCenterByUserLocation( \googlemaps\core\LatLng $backup_location=null ) {
		$this->enableGeolocation();
		$this->center_on_user = true;
		if ( $backup_location !== null ) {
			$this->geolocation_backup = $backup_location;
		}
	}

	function addMapStyle( \googlemaps\overlay\MapStyle $style ) {
		$this->map_styles[$style->var_name] = $style;
		return $style;
	}

	function setMapTypes( array $map_types ) {
		foreach ( $map_types as $map_type ) {
			if ( $map_type instanceof \googlemaps\overlay\MapStyle ) {
				$this->map_types[] = $map_type->var_name;
			}
			else {
				$this->map_types[] = $map_type;
			}
		}
	}

	public function getSidebar( $marker_html='', $tabs_deep=0 ) {
		$sidebar_html = sprintf( "%s<div id=\"%s_sidebar\">\n%s<ul class=\"sidebar\">\n", str_repeat( "\t", $tabs_deep ), $this->map_id, str_repeat( "\t", $tabs_deep+1 ) );
		foreach( $this->getMarkers() as $marker ) {
			if ( $marker_html ) {
				$marker_parsed_html = str_replace( array( '$title', '$content', '$icon' ), array( $marker->title, $marker->content, $marker->icon instanceof \googlemaps\overlay\MarkerIcon ? $marker->icon->icon : '' ), $marker_html );
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

	public function enableGeolocation( $geolocation_timeout=null, $geolocation_high_accuracy=null ) {
		if ( $geolocation_timeout ) $this->geolocation_timeout = (int) $geolocation_timeout;
		if ( $geolocation_high_accuracy ) $this->geolocation_high_accuracy = (bool) $geolocation_high_accuracy;
		$this->geolocation = true;
	}

	public function setZoom( $zoom ) {
		$this->zoom = abs( (int) $zoom ); 
	}

	public function setWidth( $width ) {
		$this->width = $width;
	}
	public function setHeight( $height ) {
		$this->height = $height;
	}

	public function setUnitsMetric() {
		$this->setUnits( 'metric' );
	}
	public function setUnitsImperial() {
		$this->setUnits( 'imperial' );
	}
	private function setUnits( $units ) {
		$this->units = $units;
	}

	public function enableScrolling() {
		$this->scrollable = true;
	}
	public function disableScrolling() {
		$this->scrollable = false;
	}

	public function enableDragging() {
		$this->draggable = true;
	}
	public function disableDragging() {
		$this->draggable = false;
	}

	public function enableAutoEncompass() {
		$this->auto_encompass = true;
	}
	public function disableAutoEncompass() {
		$this->auto_encompass = false;
	}

	public function enableCompressedOutput() {
		$this->compress_output = true;
	}
	public function disbleCompressedOutput() {
		$this->compress_output = false;
	}

	public function setMapType( $map_type ) {
		$this->map_type = $map_type;
	}

	public function setNavigationControlStyle( $style ) {
		$this->navigation_control_style = $style;
	}

	public function setMapTypeControlStyle( $style ) {
		$this->map_type_control_style = $style;
	}

	public function setMapTypeControlPosition( $position ) {
		$this->map_type_control_position = $position;
	}

	public function setNavigationControlPosition( $position ) {
		$this->navigation_control_position = $position;
	}

	public function setScaleControlPosition( $position ) {
		$this->scale_control_position = $position;
	}

	public function enableScaleControl() {
		$this->scale_control = true;
	}
	public function disableScaleControl() {
		$this->scale_control = true;
	}

	public function enableNavigationControl() {
		$this->navigation_control = false;
	}
	function disableNavigationControl() {
		$this->navigation_control = false;
	}

	function enableMapTypeControl() {
		$this->map_type_control = false;
	}
	function disableMapTypeControl() {
		$this->map_type_control = false;
	}


	/**
	 * Add an event listener to the map
	 *
	 * @param DomEventListener $event_listener
	 * @return EventListenerDecorator
	 * @access protected
	 */
	protected function addEventListener( DomEventListener $event_listener ) {
		return $this->event_listeners[] = new \googlemaps\event\EventListenerDecorator( $event_listener, count( $this->event_listeners ), $this->map_id );
	}

/*************************************
 *
 * Markers
 *
 **************************************/

	/**
	 * Add a marker to the map
	 *
	 * @param Marker $marker Marker to add
	 * @return MarkerDecorator
	 * @access protected
	 */
	protected function addMarker( \googlemaps\overlay\Marker $marker ) {
		if ( !$marker->icon && $this->default_marker_icon ) {
			$marker->setIcon( $this->default_marker_icon, $this->default_marker_shadow ?: null );
		}
		return $this->markers[] = new \googlemaps\overlay\MarkerDecorator( $marker, count( $this->markers ), $this->map_id );
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
	public function setDefaultMarkerIcon( \googlemaps\overlay\MarkerIcon $icon, \googlemaps\overlay\MarkerIcon $shadow = null ) {
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
		return $this->marker_groups;
	}


/**************************************
 *
 * Objects
 *
 **************************************/
 
 	/**
 	 * Add object
 	 * Add an object to the map
 	 * This method calls the various protected add* methods() 
 	 *
 	 * @param object $object Object to add to the map
 	 * @return object Returns a decorated object
 	 */
	public function addObject( $object ) {
		if ( !is_object( $object ) ) {
			return false;
		}
		switch( get_class( $object ) ) {
			case 'googlemaps\overlay\Marker':
				return $this->addMarker( $object );
				break;
			case 'googlemaps\overlay\MapStyle':
				return $this->addMapStyle( $object );
				break;
			case 'googlemaps\layer\FusionTable':
				return $this->addFusionTable( $object );
				break;
			case 'googlemaps\layer\KmlLayer':
				return $this->addKmlLayer( $object );
				break;
			case 'googlemaps\event\EventListener':
			case 'googlemaps\event\DomEventListener':
				return $this->addEventListener( $object );
			case 'googlemaps\overlay\Circle':
			case 'googlemaps\overlay\Rectangle':
				return $this->addShape( $object );
				break;
			case 'googlemaps\overlay\WalkingDirections':
			case 'googlemaps\overlay\BicyclingDirections':
			case 'googlemaps\overlay\DrivingDirections':
				return $this->addDirections( $object );
				break;
			default:
				trigger_error( 'Invalid object passed to addObject()' , E_USER_ERROR );
		}
	}

	/**
	 * Add an array objects to the map
	 * 
	 * @return array Returns an array of decorated map objects
	 */
	public function addObjects( array $objects=null ) {
		foreach( $objects as $object ) {
			$r[] = $this->addObject( $object );
		}
		return $r;
	}


/******************************************
 *
 * Javascript output
 *
 ******************************************/

	function printMap() {
		echo $this->getMap();
	}

	function getMap() {
		return sprintf( '<div id="%s" style="%s%s"></div>', $this->map_id, ( $this->width ? 'width: ' . $this->width . ';' : '' ), ( $this->height ? 'height: ' . $this->height . ';' : '' ) );
	}

	function printHeaderJS() {
		echo $this->getHeaderJS();
	}

	function getHeaderJS() {
		return sprintf( "%s<script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=%s&v=%s&language=%s&region=%s\"></script>\n\n", ( $this->mobile ? "<meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\">\n" : '' ), json_encode( $this->sensor ), $this->api_version, $this->language, $this->region );
	}

	function printMapJS() {
		echo $this->getMapJS();
	}

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
			$output .= sprintf( "\t%sStyleOptions = { name: \"%s\"}\n", $map_style->var_name, $map_style->name );
			$output .= sprintf( "\t%sMapType = new google.maps.StyledMapType(%sMapStyle, %sStyleOptions);\n", $map_style->var_name, $map_style->var_name, $map_style->var_name );
			$output .= sprintf( "\tthis.map.mapTypes.set('%s', %sMapType);\n", $map_style->var_name, $map_style->var_name );
		}

		if ( count( $this->shapes ) ) {
			$output .= sprintf( "\n\tthis.shapes = [];\n", $this->map_id );
			foreach( $this->shapes as $n => $shape ) {
				if ( $shape->decoratee instanceof \googlemaps\overlay\Circle ) {
		  			$output .= sprintf( "\tthis.shapes[%s] = new google.maps.Circle( {\n", $n );
					$output .= sprintf( "\t\tcenter: new google.maps.LatLng(%s,%s),\n", $shape->center->lat, $shape->center->lng );
					$output .= sprintf( "\t\tradius: %s,\n", $shape->radius );
					$output .= sprintf( "\t\tmap: this.map\n" );
					$output .= "\t} );\n";
				}
				elseif ( $shape->decoratee instanceof \googlemaps\overlay\Rectangle ) {
		  			$output .= sprintf( "\tthis.shapes[%s] = new google.maps.Rectangle( {\n", $n );
					$output .= sprintf( "\t\tbounds: new google.maps.LatLngBounds(new google.maps.LatLng(%s,%s),new google.maps.LatLng(%s,%s)),\n",
										$shape->southwest->lat,
										$shape->southwest->lng,
										$shape->northeast->lat,
										$shape->northeast->lng
									);
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
		  				$renderer_options .= sprintf( "\t\t%s:%s,\n", $renderer_option, $this->phpToJs( $renderer_value, null, null, true ) );
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
		  				$request_options .= sprintf("\t\twaypoints: %s,\n", $this->parseLatLngs( $request_value ) );
		  			case 'origin':
				  		$request_options .= sprintf( "\t\torigin: new google.maps.LatLng(%s,%s),\n", $this->directions->request_options['origin']->lat, $this->directions->request_options['origin']->lng );
					  	break;
					case 'destination':
				  		$request_options .= sprintf( "\t\tdestination: new google.maps.LatLng(%s,%s),\n", $this->directions->request_options['destination']->lat, $this->directions->request_options['destination']->lng );
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
		  	$output .= sprintf( "\t\n\tthis.directions.service.route(this.directions.request_options, function(response,status) {\n\t\tif (status == google.maps.DirectionsStatus.OK) {\n\t\t\tself.directions.success = response;\n\t\t\tself.directions.renderer.setDirections(response);%s\n\t\t}\n\t\telse {\n\t\t\tself.directions.error = status;%s\n\t\t}\n\t});\n\n",
		  		( $this->directions_success_callback ? sprintf( "\n\t\t\t%s(response);", $this->directions_success_callback ) : "" ),
		  		( $this->directions_fail_callback ? sprintf( "\n\t\t\t%s(status);", $this->directions_fail_callback ) : "" )
		  	);
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

		if ( count( $this->markers ) && $this->info_windows ) {
			$output .= "\tthis.info_window = new google.maps.InfoWindow();\n";
	  	}

		// Print marker shapes
		if ( count( $this->marker_shapes ) ) {
			$output .= sprintf( "\n\tthis.marker_shapes = [];\n", $this->map_id );
		  	foreach ( $this->marker_shapes as $shape_id => $marker_shape ) {
	  			$output .= sprintf( "\tthis.marker_shapes[%s] = {\n", $shape_id );
				$output .= sprintf( "\t\ttype: \"%s\",\n", $marker_shape->type );
				$output .= sprintf( "\t\tcoord: [%s]\n", implode( ",", $marker_shape->coords ) );
				$output .= "\t};\n";
		  	}
	  	}

		// Print marker groups
		if ( count( $this->marker_groups ) ) {
			$output .= "\n\tthis.marker_groups = [];\n";
			$output .= "\tthis.marker_group_toggle = function( group_name ) {\n\t\tfor (i in this.marker_groups[group_name].markers) {\n\t\t\tvar marker = this.markers[this.marker_groups[group_name].markers[i]];\n\t\t\tif (marker.getVisible()) {\n\t\t\t\tmarker.setVisible( false );\n\t\t\t} else {\n\t\t\t\tmarker.setVisible( true );\n\t\t\t}\n\t\t}\n\t};\n";
			//$output .= "\tthis.marker_group_radio = function( group_name ) {\n\t\tfor ( i in this.markers ) {\n\t\t\tif ( this.marker_groups[group_name].markers.indexOf(i) < 0 ) {\n\t\t\t\tthis.markers[i].setVisible(false);\n\t\t\t}\n\t\t}\n\t};\n";
			//$output .= "\tthis.marker_group_show = function( group_name ) {\n\t\tfor ( i in this.marker_groups[group_name].markers ) {\n\t\t\tthis.markers[i].setVisible(true);\n\t\t}\n\t};";
			foreach( $this->marker_groups as $marker_group_var => $marker_group ) {
				$output .= sprintf( "\tthis.marker_groups[\"%s\"] = {name: \"%s\", markers:[%s]};\n", $marker_group_var, $marker_group->name, implode( ',', $marker_group->markers ) );
			}
	  	}

		if ( count( $this->markers ) ) {
			$output .= "\n\tthis.markers = [];\n";
	  	}

	  	foreach ( $this->getMarkers() as $marker_id => $marker ) {
	  		if ( $marker->geolocation ) {
	  			if ( !$this->geolocation ) {
		  			$this->enableGeolocation();
	  			}
	  			$output .= "\tif ( navigator.geolocation && typeof geolocation != 'undefined' ) {\n";
	  		}
	  	
			$output .= sprintf( "\tthis.markers[%s] = new google.maps.Marker({\n", $marker_id );
			if ( $marker->geolocation ) {
				$output .= "\t\tposition: geolocation,\n";
			}
			else {
				$output .= sprintf( "\t\tposition: new google.maps.LatLng(%s,%s),\n", $marker->lat, $marker->lng );			
			}
			$output .= "\t\tmap: this.map,\n";

			if ( is_int( $marker->icon_id ) ) {
				$output .= sprintf( "\t\ticon:this.marker_icons[%s],\n", $marker->icon_id );
			}
			if ( is_int( $marker->shadow_id ) ) {
				$output .= sprintf( "\t\tshadow:this.marker_icons[%s],\n", $marker->shadow_id );
			}
			if ( is_int( $marker->shape_id ) ) {
				$output .= sprintf( "\t\tshape:this.marker_shapes[%s],\n", $marker->shape_id );
			}
			if ( count( $marker->groups ) ) {
				$gs = $this->marker_groups;
				$output .= sprintf( "\t\tgroups:[%s],\n", implode( ',', array_map( function( $g ) use ( $gs ) { return $gs[$g->var_name]->id; }, $marker->groups ) ) );
			}
			foreach( $marker->getOptions() as $marker_option => $marker_value ) {
				if ( $marker_option == 'sidebar' || $marker_option == 'sidebar_html' ) {
					continue;
				}
				$output .= sprintf( "\t\t%s:%s,\n", $marker_option, $this->phpToJs( $marker_value ) );
			}
			
			$output .= "\t});\n";

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

		if ( count( $this->kml_layers ) ) {
			$output .= "\tthis.kml_layers = [];\n";
			foreach( $this->kml_layers as $n => $kml_layer ) {
		  		$output .= sprintf( "\tthis.kml_layers[%s] = new google.maps.KmlLayer('%s', %s);\n\tthis.kml_layers[%s].setMap(this.map);\n\n", $n, $kml_layer->url, $this->phpToJs( $kml_layer->options ), $n );
			}
		}

		if ( count( $this->fusion_tables ) ) {
			$output .= "\tthis.fusion_tables = [];\n";
		  	foreach ( $this->fusion_tables as $k => $fusion_table ) {
				$ft_options = '';
				foreach( $fusion_table->getOptions() as $var => $val ) {
					$ft_options .= sprintf( "\t\t%s: %s,\n", $this->phpToJs( $var ), $this->phpToJs( $val ) );
				}
		  		$output .= sprintf( "\tthis.fusion_tables[%s] = new google.maps.FusionTablesLayer(%s, {\n%s\t});\n\tthis.fusion_tables[%s].setMap(this.map);\n\n", $k, $fusion_table->table_id, $ft_options, $k );
		  	}
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
			if ( $this->geolocation ) {
				$output .= sprintf( "\t}\n\telse {\n\t\tthis.map.setCenter( new google.maps.LatLng(%s,%s) );\n\t}\n\n", $this->geolocation_backup->lat, $this->geolocation_backup->lng );
			}
		}
	  	if ( $this->center ) {
			$output .= sprintf( "\tthis.map.setCenter( new google.maps.LatLng(%s,%s) );\n", $this->center->lat, $this->center->lng );
		}
	  	
	  	if ( count ($this->event_listeners ) ) {
			$output .= "\tthis.event_listeners = [];\n";
	  		foreach( $this->event_listeners as $n => $event_listener ) {
		  		$output .= sprintf( "\tthis.event_listeners[%s] = google.maps.event.add%sListener%s(%s, '%s', %s);\n",
		  						$n,
		  						get_class( $event_listener->decoratee ) == 'googlemaps\event\DOMEventListener' ? 'Dom' : '',
		  						$event_listener->once ? 'Once' : '',
		  						isset( $event_listener->object ) ? sprintf( 'document.getElementById("%s")', $event_listener->object ) : $this->getMapJsVar(),
		  						$event_listener->event,
		  						$event_listener->function
		  					);
		  	}
	  	}

		/*
		* Add ability for multiple onload functions
		if ( $this->onload_function ) {
			$output .= sprintf( "\tgoogle.maps.event.addListenerOnce(this.map, 'idle', %s );\n", $this->onload_function );
		}
	  	*/
	  	
	  	if ( $this->streetview ) {
	  	
	  		$streetview_options = '';

			if ( isset( $this->streetview->position->lat, $this->streetview->position->lng ) ) {
				$this->streetview->options->visible = true;
	  			$streetview_options .= sprintf( "\t\tposition:new google.maps.LatLng(%s,%s),\n", $this->streetview->position->lat, $this->streetview->position->lng );
  				$streetview_options .= sprintf( "\t\tpov: {heading:%s,pitch:%s,zoom:%s},\n",$this->streetview->pov->heading, $this->streetview->pov->pitch, $this->streetview->pov->zoom );
			}

  			foreach( $this->streetview->options as $streetview_option => $streetview_value ) {
  				$streetview_options .= sprintf( "\t\t%s:%s,\n", $streetview_option, $this->phpToJs( $streetview_value ) );
  			}
  			if ( isset( $this->streetview->position->geolocation ) ) {
	  			$streetview_options .= "\t\tposition:geolocation,\n";
  			}

	  		$output .= sprintf( "\tthis.streetview = new google.maps.StreetViewPanorama(document.getElementById(\"%s\"), {\n%s\t});\n\tthis.map.setStreetView(this.streetview);\n", $this->streetview->container, $streetview_options );

	  	}
		

	  	$output .= sprintf( "\n};\n\n}\nfunction initialize_%s() {\n\t%s = new phpgooglemap_%s();\n\t%s.initialize();\n}\n\n", $this->map_id, $this->map_id, $this->map_id, $this->map_id );

		if ( $this->geolocation ) {
			$output .= "function get_geolocation() {\n";
			$output .= sprintf( "\tnavigator.geolocation.getCurrentPosition( geolocation_success_init, geolocation_error_init, {enableHighAccuracy: %s, timeout: %s} );\n", ( $this->geolocation_high_accuracy ? 'true' : 'false' ), $this->geolocation_timeout);
			$output .= "}\n";
			$output .= "function geolocation_success_init( position ) {\n";
			$output .= sprintf( "\tgeolocation_status=1;\n\tgeolocation_lat = position.coords.latitude;\n\tgeolocation_lng = position.coords.longitude;\n\tgeolocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);\n\tinitialize_%s();\n}\n", $this->map_id );
			$output .= sprintf( "function geolocation_error_init( error ){\n\tgeolocation_status=0;\n\tgeolocation_error = error.code;\n\tinitialize_%s();%s\n}\n", $this->map_id, ( $this->geolocation_fail_function ? $this->geolocation_fail_function . "();\n\t" : '' ) );
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

	private function escape( $str, $escape_quotes = false ) { 
		$e = htmlentities( $str, ENT_QUOTES, 'UTF-8' );
		if ( $escape_quotes ) {
			return self::escapeQuotes( $e );
		}
		return $e;
	}

	private function escapeQuotes( $str ) {
		return str_replace( array( '"', "'" ), array( "&#34;", "&#39;" ), $str );
	}

	private function phpToJs( $php ) {
		if ( is_null( $php ) ) {
			return '{}';
		}
		return json_encode( $php );
	}

	private function parseLatLngs( $str ) {
		return preg_replace( '~\{"lat":(.*?),"lng":(.*?)\}~i', 'new google.maps.LatLng($1,$2)', json_encode( $str ) );
	}

	private function normalizeVariable( $var ) {
		return preg_replace( '~\W~', '', $var );
	} 

	public function getMapJsVar() {
		return sprintf( '%s.map', $this->map_id );
	}

	private function extractMarkerData() {

		$hash = md5( serialize( $this->getMarkers() ) );

		if ( $hash == $this->marker_data_hash ) {
			return true;
		}

	  	foreach( $this->getMarkers() as $marker_id => $marker ) {
			if ( $marker->icon instanceof \googlemaps\overlay\MarkerIcon ) {
				if ( ( $icon_id = array_search( $marker->icon, $this->marker_icons ) ) !== false ) {
		  			$marker->icon_id = $icon_id;
	  			}
	  			else {
		  			$this->marker_icons[] = $marker->icon;
		  			$marker->icon_id = count( $this->marker_icons ) - 1;
	  			}
				if ( $marker->shadow instanceof \googlemaps\overlay\MarkerIcon ) {
					if ( ( $shadow_id = array_search( $marker->shadow, $this->marker_icons ) ) !== false ) {
		  				$marker->shadow_id = count( $this->marker_icons ) - 1;
		  			}
		  			else {
			  			$this->marker_icons[] = $marker->shadow;
						$marker->shadow_id = count( $this->marker_icons ) - 1;
		  			}
				}
			}
  			if ( $marker->shape instanceof \googlemaps\overlay\MarkerShape ) {
				if ( ( $shape_id = array_search( $marker->shape, $this->marker_shapes ) ) !== false ) {
					$marker->shape_id = $shape_id;
	  			}
	  			else {
		  			$this->marker_shapes[] = $marker->shape;
					$marker->shape_id = count( $this->marker_shapes ) - 1;
	  			}
  			}
  			foreach ( $marker->groups as $marker_group ) {
  				if ( isset( $this->marker_groups[ $marker_group->var_name ] ) ) {
  					$this->marker_groups[ $marker_group->var_name ]->addMarker( $marker_id );
  				}
  				else {
  					$this->marker_groups[ $marker_group->var_name ] = new \googlemaps\overlay\MarkerGroupDecorator( $marker_group, count( $this->marker_groups ), $this->map_id );
  					$this->marker_groups[ $marker_group->var_name ]->addMarker( $marker_id );
  				}
			}

	  	}
	  	$this->marker_data_hash = md5( serialize( $this->getMarkers() ) );

	}

}

