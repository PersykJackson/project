<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'on');

include_once '../autoload.php';
$path = trim($_SERVER['REQUEST_URI'], '/');
$loader = new LayoutLoader(array(), $path);
$loader->render();