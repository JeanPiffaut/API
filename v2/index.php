<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Access-Control-Max-Age: 3600");

if(isset($_REQUEST['service']) && $_REQUEST['service'] != "") {

    $service = $_REQUEST['service'];
} else {

    $service = "product";
}

include_once dirname(__DIR__) . "/v2/" . $service . ".php";

$product = new $service();
$product->setParams($_REQUEST);

$result = match ($_SERVER['REQUEST_METHOD']) {
    "POST" => $product->post(),
    "PUT" => $product->put(),
    "PATCH" => $product->patch(),
    default => $product->get(),
};

print json_encode($product);
