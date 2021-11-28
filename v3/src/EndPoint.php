<?php

include_once dirname(__DIR__) . "/src/endpoint_result.php";

abstract class EndPoint
{
    protected endpoint_result $result;

    public function setParams(array $params): void
    {
        foreach ($params as $key => $value) {

            if(property_exists($this, $key)) {

                $this->$key = $value;
            }
        }
    }

    /**
     * Allows to obtain information from the endpoint called
     * @return endpoint_result
     */
    public function get(): endpoint_result
    {
        $this->setResult(405);
        return $this->getResult();
    }

    /**
     * Create elements in the endpoint called
     * @return endpoint_result
     */
    public function post(): endpoint_result
    {
        $this->setResult(405);
        return $this->getResult();
    }

    /**
     * Update or replace items on the endpoint named
     * @return endpoint_result
     */
    public function put(): endpoint_result
    {
        $this->setResult(405);
        return $this->getResult();
    }

    /**
     * Updates or modifies items on the endpoint called
     * @return endpoint_result
     */
    public function patch(): endpoint_result
    {
        $this->setResult(405);
        return $this->getResult();
    }

    /**
     * Deletes items at the endpoint called
     * @return endpoint_result
     */
    public function delete(): endpoint_result
    {
        $this->setResult(405);
        return $this->getResult();
    }

    /**
     * Configures the result that will be obtained from the endpoint.
     * @param $code
     * @param array $contents
     */
    protected function setResult($code, array $contents = array()): void
    {
        $result = new endpoint_result($code);
        $this->result = $result;

        foreach ($contents as $key => $content) {

            $this->result->setRequest($key, $content);
        }
    }

    /**
     * Returns the result object of the endpoint
     * @return endpoint_result
     */
    protected function getResult(): endpoint_result
    {
        return $this->result;
    }
}