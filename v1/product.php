<?php

include_once dirname(__DIR__) . "/v2/src/EndPoint.php";

class product extends EndPoint
{
    public function post(): endpoint_result
    {
        $this->setResult(200);
        return $this->getResult();
    }
}
