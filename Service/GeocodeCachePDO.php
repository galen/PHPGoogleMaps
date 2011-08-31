<?php

namespace PHPGoogleMaps\Service;

class GeocodeCachePDO implements GeocodeCache {

	/**
	 * PDO object
	 *
	 * @var PDO
	 */
	protected $db;

	/**
	 * Cache table
	 * Default is 'geocode_cache'
	 * This must have a lat, lng, and location field
	 *
	 * @var string
	 */
	protected $db_table;

	/**
	 * Constructor
	 *
	 * @param string $host DB host
	 * @param string $user username
	 * @param string $pw password
	 * @param string db_name DB name
	 * @param string $db_table DB table
	 * @param string $db_type DB type
	 * @return GeocodeCachePDO
	 */
	public function __construct( $host, $user, $pw, $db_name, $db_table='geocode_cache', $db_type='mysql' ) {
		$this->db = new \PDO( "$db_type:host=$host;dbname=$db_name", $user, $pw );
		$this->db_table = $db_table;
	}

	/**
	 * Get cached location
	 *
	 * @param string $location Location to get from cache
	 * @return false|GeocodeCachedResult
	 */
	public function getCache( $location ) {
		$get = $this->db->prepare( sprintf( 'select lat, lng from %s where location=:location limit 1', $this->db_table ) );
		$get->bindValue( ':location', $location );
		if ( !$get->execute() ) {
			return false;
		}
		$result = $get->fetchAll( \PDO::FETCH_ASSOC );
		if ( count( $result ) ) {
			return new \PHPGoogleMaps\Service\CachedGeocodeResult( new \PHPGoogleMaps\Core\LatLng( $result[0]['lat'], $result[0]['lng'], $location ), true );
		}
		return false;
	}

	/**
	 * Write to cache
	 *
	 * @param string $location Location to write to cache
	 * @param float $lat Latitude of location
	 * @param float $lng Longitude of location
	 * @return bool
	 */
	public function writeCache( $location, $lat, $lng ) {
		$put = $this->db->prepare( sprintf( 'insert into %s (lat,lng,location) values(:lat,:lng,:location)', $this->db_table, $lat, $lng, $location ) );
		$put->bindValue( ':lat', $lat );
		$put->bindValue( ':lng', $lng );
		$put->bindValue( ':location', $location );
		$put->execute();
		return (bool) $put->rowCount();
	}

}