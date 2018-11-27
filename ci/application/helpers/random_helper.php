<?php

function generate_random_string($prepend='',$append='',$length=NULL)
{
	$length = empty($length) ? ID_STRING_LENGTH : $length;

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
    $characters_length = strlen($characters);
    $randomString = isset($prepend) ? $prepend : '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $characters_length - 1)];
    }
    return $randomString.@$append;
}
