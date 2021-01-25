<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../LayoutLoader.php';
$loader = new LayoutLoader(array('style' => 'index.css'), 'layout.php');
$loader->render();