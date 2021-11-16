<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Access-Control-Max-Age: 3600");

$service = $_REQUEST['service'];

include_once dirname(__DIR__) . "/v2/" . $service . ".php";

$product = new $service();

switch ($_SERVER['REQUEST_METHOD'])
{
    case "POST":

        $result = $product->post();
        break;

    case "PUT":

        $result = $product->put();
        break;

    case "PATCH":

        $result = $product->patch();
        break;
    default:

        $result = $product->get();
        break;
}


print json_encode($result);
