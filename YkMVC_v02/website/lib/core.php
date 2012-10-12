<?php

/* fix put | delete
if( !empty($_POST['_method']) && in_array($_POST['_method'], array('put', 'delete')) ) {
  $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
}
*/

//fix :
if (!function_exists('lcfirst')) {
	function lcfirst($string) {
		$string[0] = strtolower($string[0]);
		return $string;
	}
}

if (!function_exists('ucfirst')) {
	function lcfirst($string) {
		$string[0] = strtoupper($string[0]);
		return $string;
	}
}



include_once 'Object.php';
include_once 'Controller.php';
include_once 'Model.php';

include_once 'Router.php';

// config
include CONFIG_PATH . 'config.php';
// map routes:
include CONFIG_PATH . 'routes.php';
Router::checkAndFirteNotFound();
