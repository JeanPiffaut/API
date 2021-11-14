<?php

class endpoint_result
{
    public int $code;
    public string $message;
    private array $codes = [
        200 => "Ok",
        201 => "Created",
        400 => "Bad Request",
        401 => "Unauthorized",
        404 => "Not Found",
        405 => "Method Not Allowed",
        409 => "Conflict",
        500 => "Internal Server Error"
    ];

    public function __construct(int $code)
    {
        $this->setCode($code);
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    private function setCode(int $code): void
    {
        $this->code = $code;
        $this->message = $this->codes[$code];
    }


}
