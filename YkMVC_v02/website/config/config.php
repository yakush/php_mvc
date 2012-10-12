<?php
/*
 * user defined configurations file
 * you can do the app setup here.
 */

session_start();
///////////////////////////////////
define('IS_LOCAL', ($_SERVER['SERVER_NAME'] == 'localhost') ? true : false);

//debug:
if (IS_LOCAL){
	error_reporting(E_ALL);
}else{
	
}


/*
$SITE_URL_LOCAL = "http://localhost/moody_design/";
$SITE_URL_SERVER = "http://yakstudio.com/moody_design/";

$SITE_URL_PATH_LOCAL = "/moody_design/";
$SITE_URL_PATH_SERVER = "/moody_design/";

$IMAGES_DIR = "data/images/";

$SITE_TITLE = "moody design";

$SIGNUP_TOKEN = "moodymoodymoody";

///////////////////////////////////


if($IS_LOCAL){
	$SITE_URL = $SITE_URL_LOCAL;
	$SITE_URL_PATH=$SITE_URL_PATH_LOCAL;
}else{
	$SITE_URL = $SITE_URL_SERVER;
	$SITE_URL_PATH=$SITE_URL_PATH_SERVER;
}

$IMAGES_DIR_ABSOLUTE = $SITE_URL . $IMAGES_DIR;

// MAIN DATABASE
if($IS_LOCAL){
	$SQLServer = "localhost";
	$SQLUsername = "root";
	$SQLPassword = "";
	$SQLDatabase = "moody_design";
}else{
	$SQLServer = "moodydesign.db.5243411.hostedresource.com";
	$SQLUsername = "moodydesign";
	$SQLPassword = "Woofwoof123";
	$SQLDatabase = "moodydesign";
}

$GLOBALS['normalizeChars'] = array(
		'�'=>'S', '�'=>'s', '�'=>'Dj','�'=>'Z', '�'=>'z', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
		'�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E', '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I',
		'�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U',
		'�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss','�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a',
		'�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i',
		'�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u',
		'�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b', '�'=>'y', '�'=>'f'
);
*/

