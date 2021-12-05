<?php

// Set the page content as JSON and UTF-8
header("Content-Type: application/json; charset=UTF-8");

// Add the configuration file
include_once __DIR__ . "/src/config.php";
global $CONFIG;

// Configure API access methods
header("Access-Control-Allow-Methods: " . implode($CONFIG['access']['methods']));

// Validates if the called endpoint was sent.
if(isset($_REQUEST['service']) && $_REQUEST['service'] != "") {

    $service = $_REQUEST['service'];
} else {

    $service = $CONFIG['project']['default_page'];
}

// Validates if the called endpoint exists as a file.
$endpoint_path = __DIR__ . "/controller/" . $service . ".php";
if(file_exists($endpoint_path) === false) {

    // In case it does not exist, the default endpoint will be used.
    $service = $CONFIG['project']['default_page'];
    $endpoint_path = __DIR__ . "/src/" . $service . ".php";
}

// Includes the endpoint file
include_once $endpoint_path;

// Execute the endpoint and configure the sent parameters.
$product = new $service();
$product->setParams($_REQUEST);

// Check the method used for the call and execute its function accordingly.
$result = match ($_SERVER['REQUEST_METHOD']) {
    "POST" => $product->post(),
    "PUT" => $product->put(),
    "PATCH" => $product->patch(),
    default => $product->get(),
};

// Returns the result object and prints it in JSON format
exit(json_encode($product));
