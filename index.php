<?php

include_once "src/autoload.php";

use Library\Configuration;

$conf = new Configuration();
$conf->setConfig("config.json");

var_dump(Configuration::getConfig("project", "name"));
