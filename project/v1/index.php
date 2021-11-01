<?php

include_once dirname(__DIR__) . "/../src/autoload.php";

use Library\Configuration;

$conf = new Configuration();
$conf->setConfig(dirname(__DIR__) . "/config.json");

if ($conf->getErrors() !== false) {

    var_dump($conf->getErrors());
}

var_dump(Configuration::getConfig("project", "name"));
var_dump($_REQUEST);
