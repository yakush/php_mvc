<?php

/* fix put | delete
if( !empty($_POST['_method']) && in_array($_POST['_method'], array('put', 'delete')) ) {
  $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
}
*/

include_once 'Object.php';
include_once 'Controller.php';
include_once 'Model.php';

include_once 'Router.php';

// config
include CONFIG_PATH . 'config.php';
// map routes:
include CONFIG_PATH . 'routes.php';
Router::checkAndFirteNotFound();
