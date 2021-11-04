<?php

include_once dirname(__DIR__) . "/../src/autoload.php";

use Library\Configuration;

// Initialization of the project configuration.
$conf = new Configuration();
$conf->setConfig(dirname(__DIR__) . "/v1/config.json");
$conf->setConfig(dirname(__DIR__) . "/config.json");

// Validates if there was an error in the loading of the configuration files.
if ($conf->getErrors() !== false) {

    var_dump($conf->getErrors());
}

// Execute the basic configurations necessary for the project to work as expected.
$conf->setDateTimeZone(Configuration::getConfig("project", "timezone"));

$response = new \Library\Response();

if(Configuration::getConfig("project", "debug") === false) {

    ob_start();
} else {

    $response->setHeaders();
}

if(Configuration::getConfig("project", "debug") === false) {

    ob_end_clean();
}

