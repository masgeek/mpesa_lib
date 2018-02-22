<?php
$root_dir = dirname(dirname(__FILE__));

require_once $root_dir . '/vendor/autoload.php';


// Tell log4php to use our configuration file.
Logger::configure($root_dir.'/config/config.xml');

$callbackParams = serialize($_POST);

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('myLogger');

// Start logging
$log->info($_POST);