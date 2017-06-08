<?php
//Front controller

//1. General settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

//2.Connect files of system
define('ROOT', dirname(__FILE__));
/*define('LANG', 'Lang::arrLang[$_SESSION["lang"]]');*/
include_once(ROOT.'/core/db.php');
//require_once(ROOT.'/project4/config/lang.php');
require_once(ROOT.'/core/router.php');

$router = new Router();
$router->run();

