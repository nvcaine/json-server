<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("framework/main.php"); // init framework

$currentPage = $appFacade->getCurrentSection("service");

$appFacade->handleSectionRequest($currentPage); //autoload and run section controller entry-point method
?>