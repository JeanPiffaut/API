<?php

// Set the page content as JSON and UTF-8
header("Content-Type: application/json; charset=UTF-8");

// Add the autoload file
include_once __DIR__ . "/src/autoload.php";
global $CONFIG;

// Configure API access methods
header("Access-Control-Allow-Methods: " . implode($CONFIG['access']['methods']));

// Configure the error handler with the internal API function
set_error_handler("Directory\api_error_handler", E_ALL);

// Validates if the called endpoint was sent.
if(isset($_GET['service']) && $_GET['service'] != "") {

    $service = $_GET['service'];
} else {

    $service = $CONFIG['project']['default_page'];
}

// Validates if the called endpoint exists as a file.
$endpoint_path = __DIR__ . "/controller/" . $service . ".php";
if(file_exists($endpoint_path) === false) {

    // In case it does not exist, the default endpoint will be used.
    $service = $CONFIG['project']['default_page'];
    $endpoint_path = __DIR__ . "/controller/" . $service . ".php";
}

// Includes the endpoint file
include_once $endpoint_path;

// Execute the endpoint and configure the sent parameters.
$endpoint_obj = new $service();
$endpoint_obj->setParams($_REQUEST);

// Check the method used for the call and execute its function accordingly.
$result = match ($_SERVER['REQUEST_METHOD']) {
    "POST" =>   $endpoint_obj->post(),
    "PUT" =>    $endpoint_obj->put(),
    "PATCH" =>  $endpoint_obj->patch(),
    "DELETE" => $endpoint_obj->detele(),
    default =>  $endpoint_obj->get()
};

// Returns the result object and prints it in JSON format
exit(json_encode($result));
