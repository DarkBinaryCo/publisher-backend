<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *@param $url The path to the asset in the asset directory 
 *@return string Returns a url for an asset in the assigned assets directory
*/
function asset_url($url)
{
	return base_url(ASSET_DIR.$url);
}
