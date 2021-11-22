<?php

use Directory\EndPoint;

class home extends EndPoint
{
    public string $poto;

    public function get(): endpoint_result
    {
        $this->setResult(200, array("poto" => $this->poto));
        return $this->getResult();
    }

    public function post(): endpoint_result
    {
        $this->setResult(200, array("poto" => $this->poto));
        return $this->getResult();
    }
}
