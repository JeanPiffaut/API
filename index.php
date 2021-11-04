<?php

include_once dirname(__DIR__) . "/API/src/autoload.php";

use Library\Configuration;

// Initialization of the project configuration.
$conf = new Configuration();
$conf->setConfig(dirname(__DIR__) . "/API/project/config.json");

header('Content-Type: application/json');

print json_encode(array(
    "status" => [
        "code" => "0",
        "description" => "success",
    ],
    "response" => [
        "documentation" => Configuration::getConfig("documentation", "link")
    ]
), JSON_THROW_ON_ERROR);
