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
        $this->setResult(200);
        return $this->getResult();
    }

    public function setEndPointParams(string $name, mixed $value): void
    {
        switch ($name) {
            case "poto":
                $this->setPoto($value);
                break;
        }
    }

    /**
     * @return string
     */
    public function getPoto(): string
    {
        return $this->poto;
    }

    /**
     * @param string $poto
     */
    public function setPoto(string $poto): void
    {
        $this->poto = $poto;
    }
}
