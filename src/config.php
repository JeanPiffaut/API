<?php

$CONFIG = array();

global $CONFIG;

// Project config
$CONFIG['project']['debug'] = true;
$CONFIG['project']['default_page'] = "home";

// Access config
$CONFIG['access']['methods'] = ["GET", "POST", "PUT", "PATCH", "DELETE"];

// Error config
if($CONFIG['project']['debug'] === true) {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
