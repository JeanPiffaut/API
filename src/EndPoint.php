<?php

namespace Library;

abstract class EndPoint extends Structure
{
    private array|false $basic_params = false;
    private array $params;

    /**
     * @param string $key
     * @return mixed
     */
    public function getParams(string $key = ""): mixed
    {
        if(empty($key) === true) {

            return $this->params;
        } else {

            if (isset($this->params[$key]) === true) {

                return $this->params[$key];
            } else {

                $this->setErrors("The requested parameter does not exist.");
                return false;
            }
        }
    }

    /**
     * @param array $params
     * @return bool
     */
    public function setParams(array $params): bool
    {
        if ($this->basic_params === false) {

            $this->params = $params;
            return true;
        } else {

            foreach ($this->basic_params as $basic) {

                if (isset($params[$basic]) === false) {

                    $this->setErrors("The required parameters were not sent.");
                    return false;
                }
            }
        }
    }


}
