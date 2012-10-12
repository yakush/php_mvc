<?php

//pathes:
define('BASE_PATH', dirname(realpath(__FILE__)) . '/');
define('APP_PATH', BASE_PATH . 'app/');
define('LIB_PATH', BASE_PATH . 'lib/');
define('CONFIG_PATH', BASE_PATH . 'config/');


define('CONTOLLERS_PATH', APP_PATH . 'controllers/');
define('VIEWS_PATH', APP_PATH . 'views/');
define('MODELS_PATH', APP_PATH . 'models/');

define('PARTIALS_PATH', APP_PATH . 'partials/');
define('LAYOUTS_PATH', APP_PATH . 'layouts/');

//run MVC core:
include LIB_PATH . 'core.php';