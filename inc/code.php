<?php

function asc2bin($str)
{
	$code_array = explode("\r\n", chunk_split($str, 1));
	for ($n = 0; $n < count($code_array) - 1; $n++)
	{
		$newstring .= substr("0000".base_convert(ord($code_array[$n]), 10, 2), -8);
	}
	$newstring = chunk_split($newstring, 8, " ");	
	return $newstring;
}	

function bin2asc($str)
{
	$str = str_replace(" ", "", $str);
	$code_array = explode("\r\n", chunk_split($str, 8));
	for ($n = 0; $n < count($code_array) - 1; $n++)
	{
		$newstring .= chr(base_convert($code_array[$n], 2, 10));
	}
	return $newstring;
}

function asc2hex($str)
{
	return chunk_split(bin2hex($str), 2, " ");
}

function hex2asc($str)
{
	$str = str_replace(" ", "", $str);
	for ($n=0; $n<strlen($str); $n+=2)
	{
		$newstring .=	pack("C", hexdec(substr($str, $n, 2)));
	}
	return $newstring;
}

function binary2hex($str)
{
	$str = str_replace(" ", "", $str);
	$code_array = explode("\r\n", chunk_split($str, 8));
	for ($n = 0; $n < count($code_array) - 1; $n++)
	{
		$newstring .= str_pad(base_convert($code_array[$n], 2, 16), 2, "0", STR_PAD_LEFT);
	}
	$newstring = chunk_split($newstring, 2, " ");
	return $newstring;
}	

function hex2binary($str)
{
	$str = str_replace(" ", "", $str);
	$code_array = explode("\r\n", chunk_split($str, 2));
	for ($n = 0; $n < count($code_array) - 1; $n++)
	{
		$newstring .= substr("0000".base_convert($code_array[$n], 16, 2), -8);
	}
	$newstring = chunk_split($newstring, 8, " ");
	return $newstring;
	}

function strip_spaces($str)
{
	$str = str_replace(" ", "", $str);
	return $str;
}

// Check to see if form has been submitted yet
if(isset($_POST['coder']))
{
	// Yes, so make sure they filled something in
	$code = $_POST['code'];

	// De/Encrypt based on selection in form
	switch ($_POST['cryptmethod'])
	{
		case 'md5':
			$code = md5($code);
			break;
		case 'gost':
			$code = hash('gost', $code);
			break;
		case 'sha1':
			$code = sha1($code);
			break;
		case 'b64enc':
			$code = base64_encode($code);
			break;
		 case 'b64dec':
			$code = base64_decode(strip_spaces($code));
			break;
		case "asc2bin":
			$code = asc2bin($code);
			break;
		 case "asc2hex":
			$code = asc2hex($code);
			break;
		 case "bin2asc":
			$code = bin2asc($code);
			break;
		 case "hex2asc":
			$code = hex2asc($code);
			break;
		case "bin2hex":
			$code = binary2hex($code);
			break;
		 case "hex2bin":
			$code = hex2binary($code);
			break;
	}

	$code = htmlentities($code, ENT_QUOTES, 'UTF-8');
}