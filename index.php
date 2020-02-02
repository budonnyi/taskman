<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//initialize base parameters
$_SESSION['error'] = '';

if (!isset($_SESSION['filter'])) $_SESSION['filter'] = 'id';
if (!isset($_SESSION['page'])) $_SESSION['page'] = 1;

//default sort order
if (!isset($_SESSION['desc'])) $_SESSION['desc'] = 'ASC';

define('ROOT', dirname(__FILE__));

//autoload files
require_once(ROOT . '/components/autoload.php');

//starting router
$router = new Router();
$router->Run();
