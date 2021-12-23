<?php

class endpoint_result
{
    public endpoint_header $header;
    public endpoint_request|array  $request = [];

    public function __construct($code)
    {
        $this->setHeader($code);
    }

    /**
     * @param string $code
     */
    public function setHeader(string $code): void
    {
        $this->header = new endpoint_header($code);
    }

    /**
     * @param $key
     * @param $sub_key
     */
    public function setRequest($key, $sub_key): void
    {
        if(is_array($this->request) === true) {

            $this->request = new endpoint_request();
        }

        $this->request->setContent($key, $sub_key);
    }

    public function setHandlerResult()
    {
        global $HANDLER_ERROR;
        $this->errors = $HANDLER_ERROR;

        unset($HANDLER_ERROR);
    }
}


class endpoint_header
{
    public int    $code;
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
        $this->setMessage($this->codes[$this->code]);
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}

class endpoint_request
{
    /**
     * @param string $key
     * @param mixed $sub_key
     */
    public function setContent(string $key, mixed $sub_key): void
    {
        $this->$key = $sub_key;
    }
}
