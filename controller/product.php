<?php

use Directory\EndPoint;

class product extends EndPoint
{
    public string $name;

    public function setEndPointParams(string $name, mixed $value): void
    {
        switch ($name) {
            case "name":
                $this->setName($value);
                break;
        }
    }

    public function post(): endpoint_result
    {
        $this->setResult(200, array("ads" => $this->name));
        return $this->getResult();
    }

    public function get(): endpoint_result
    {
        $this->setResult(200, array("name" => $this->name));
        return $this->getResult();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
