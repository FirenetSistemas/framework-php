<?php
session_start();
header("Content-Type: text/html; charset=UTF-8", true);
date_default_timezone_set("America/Bahia");

ini_set("display_errors", 1);
error_reporting(E_ALL);

define('CONTROLLERS', 'src/controllers/');
define('MODELS', 'src/models/');
define('VIEWS', 'src/views/');
define('HELPERS', 'system/helpers/');
define('WEBFILES', '/clientes/basico_melhor/');

require 'vendor/autoload.php';

use FirenetSolucoes\system\system;

$start = new System();
$start->run();