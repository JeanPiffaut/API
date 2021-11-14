<?php

include_once dirname(__DIR__) . "/v1/endpoint_result.php";

 class EndPoint
{
    public function get(): endpoint_result
    {
        return $this->setResult(405);
    }

    public function put(): endpoint_result
    {
        return $this->setResult(405);
    }

    public function delete(): endpoint_result
    {
        return $this->setResult(405);
    }

    protected function setResult($code): endpoint_result
    {
        $result = new endpoint_result($code);
        return $result;
    }
}
