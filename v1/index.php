<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Access-Control-Max-Age: 3600");

include_once dirname(__DIR__) . "/v1/EndPoint.php";

$end = new EndPoint();

print json_encode($end->get());
