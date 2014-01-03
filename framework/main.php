<?php
require_once("framework/init/AppInit.php");
require_once("framework/init/Autoloader.php");

$appInit = new AppInit("framework"); // load framewor files
$appFacade = new AppFacade(new SettingsManager("settings.xml")); // load app settings

Autoloader::init("app"); // set autoloading path
DBWrapper::configure("localhost", "root", "", "wp"); // init DB connection

spl_autoload_register(array("Autoloader", "autoload")); // register autoloading method