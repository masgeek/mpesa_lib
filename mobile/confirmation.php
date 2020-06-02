<?php
$root_dir = dirname(dirname(__FILE__));

require_once $root_dir . '/vendor/autoload.php';


$callbackJSONData = file_get_contents('php://input');

// Tell log4php to use our configuration file.
Logger::configure($root_dir . '/config/config.xml');


// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('confirmation');


$log->info(json_decode($callbackJSONData));
