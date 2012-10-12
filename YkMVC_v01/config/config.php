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
		'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
		'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
		'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
		'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
		'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
		'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
		'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
);
*/

