<?php

/* fix put | delete
if( !empty($_POST['_method']) && in_array($_POST['_method'], array('put', 'delete')) ) {
  $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
}
*/

include 'object.php';
include 'controller.php';
include 'router.php';



// map routes:
include CONFIG_PATH . 'routes.php';
Router::checkAndFirteNotFound();
