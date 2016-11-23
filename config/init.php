<?php

define('PROJECT_ROOT', realpath(dirname(__FILE__) . '/..'));
define('VIEW_ROOT'   , PROJECT_ROOT . '/app/views/');

define('COMMON_VIEW_PATH', VIEW_ROOT . 'commons/');
define('ERROR_VIEW_PATH' , VIEW_ROOT . 'errors/');

require(PROJECT_ROOT . '/config/database.php');
require(PROJECT_ROOT . '/lib/functions.php');

date_default_timezone_set('Asia/Makassar');

$path = array(
  get_include_path(),
  PROJECT_ROOT . '/lib/core/',
  PROJECT_ROOT . '/app/Model/',
  PROJECT_ROOT . '/app/Controller/'
);

set_include_path(implode(PATH_SEPARATOR, $path));
spl_autoload_register('load_class');
error_reporting(E_ALL | E_NOTICE);
