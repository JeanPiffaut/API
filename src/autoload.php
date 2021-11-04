<?php

// Composer autoload
if (file_exists(dirname(__DIR__) . "/src/composer/vendor/autoload.php")) {

    include_once dirname(__DIR__) . "/src/composer/vendor/autoload.php";
} else {

    header('Content-Type: application/json');

    print json_encode(array(
        "status" => [
            "code" => "-1",
            "description" => "error",
        ],
        "response" => [
            "message" => "There was an error in the basic structure of the system.",
            "error" => "001"
        ]
    ), JSON_THROW_ON_ERROR);
    exit();
}
