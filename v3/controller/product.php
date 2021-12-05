<?php

include_once __DIR__ . "/../src/EndPoint.php";

class product extends EndPoint
{
    public string $poto;

    public function post(): endpoint_result
    {
        $this->setResult(200);
        return $this->getResult();
    }
}
