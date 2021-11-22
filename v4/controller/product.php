<?php

use Directory\EndPoint;

class product extends EndPoint
{
    public string $poto;

    /**
     * @return endpoint_result
     */
    public function post(): endpoint_result
    {
        $this->setResult(200);
        return $this->getResult();
    }
}
