<?php

namespace PHPGoogleMaps\Utility;

/**
 * Scraper class
 * This scrapes a webpage and returns the result
 * Uses the fopen_wrappers if available then falls back on using cURL
 * Overload this to implement your own scraping functionality
 */

class Scraper {

	/**
	 * Scrapes a webpage and returns the result
	 *
	 * @param string $url
	 * @return string|boolean Returns a string containing the webpage or false
	 */
	public static function scrape( $url ) {
	
		if ( ini_get( 'allow_url_fopen' ) ) {
			return file_get_contents( $url );
		}
		elseif ( function_exists( 'curl_init' ) ) {
			$curl = curl_init();
			curl_setopt( $curl, CURLOPT_URL, $url );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $curl, CURLOPT_HEADER, 0);
			return curl_exec( $curl );
		}
		else {
				return FALSE;
		}
	
	}

}