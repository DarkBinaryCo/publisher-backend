<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function get_age($date_of_birth)
{
	$age = DateTime::createFromFormat(DEFAULT_DATE_FORMAT,$date_of_birth)->diff(
		new DateTime('now'),TRUE )->format('%y');
	return $age;
}

function get_page_title($title='')
{
	$title = !empty($title) ? SITE_NAME.' | '.$title : SITE_NAME;
	return $title;
}

// Returns a prop value if it is set and the default empty prop name if not set
function get_prop_value($prop_name)
{
	return (empty($prop_name)) ? DEFAULT_MISSING_PROP : $prop_name;
}

//Converts cm to feet
function convert_cm_to_feet($cm_value)
{
	//TODO: Convert cm to feet eg. 5'7
	return $cm_value;
}

// Returns a value if it is set or $default if not
function get_value_or_default($value,$default='')
{
	return (!empty($value)) ? $default : $value;
}

// Returns active if $value is 'truthy'
function get_active_nav($value)
{
	return ($value === TRUE) ? 'active' : '';
}

// Get whether an item should be selected or not
function get_selected($value,$comparison_value='')
{
	return ($value == $comparison_value) ? 'selected': ''; 
}

// Get whether an item should be checked or not
function get_checked($value)
{
	return ($value == TRUE) ? 'checked': ''; 
}

//Parse a message that contains placeholder data eg. [attribute] and return the parsed message
function parse_msg(string $message,array $replacements)
{
    //If the replacements are not an array ~ return the message
    if(!is_array($replacements))
    {   return $message;    }

    //Otherwise, loop through the replacements and replace them in the message provided
    foreach ($replacements as $key => $value) 
    {
        $value = (isset($value) && !empty($value)) ? $value : '[Not set]';
        // replace the $key with the value
        $replace_str = '['.(string)$key.']';;# The string to be replaced
        $message = str_replace($replace_str,$value,$message);
    }

    return $message;
}

/* End of file Utility_helper.php */
