<?php

namespace Library;

abstract class Structure
{
    private array|false $errors = false;

    /**
     * Returns the errors that were generated in the process.
     * @return array|false
     */
    public function getErrors(): bool|array
    {
        return $this->errors;
    }

    /**
     * Defines in an array the message and error code sent by parameters.
     * @param string $message
     * @param string $code
     */
    protected function setErrors(string $message, string $code = ""): void
    {
        if($this->errors === false) {

            $this->errors = array();
        }

        $this->errors[] = array(
            "code" => $code,
            "message" => $message
        );
    }
}
