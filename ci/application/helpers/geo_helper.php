<?php // Helps with getting geolocation data
defined('BASEPATH') OR exit('No direct script access allowed');

/** Get geodata of the current site visitor  */
function get_visitor_geodata()
{
	// Get the geodata based on ip address
	$api_url = 'http://ip-api.com/php/';
	
	$geo = file_get_contents($api_url);
	$geo = unserialize($geo);
	return $geo;
}

/** Returns a preformatted string representing the location information of the current visitor */
function get_visitor_location_string()
{
	$geo = get_visitor_geodata() ?? NULL;
	$city = $geo['city'] ?? 'Unknown city';
	$country = $geo['country'] ?? 'Unknown country';


	return $city.', '.$country;
}

/* End of file geo_helper.php */
