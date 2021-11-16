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
     * @return endpoint_header
     */
    public function getHeader(): endpoint_header
    {
        return $this->header;
    }

    /**
     * @param string $code
     */
    public function setHeader(string $code): void
    {
        $this->header = new endpoint_header($code);
    }

    /**
     * @return endpoint_request
     */
    public function getRequest(): endpoint_request
    {
        return $this->request;
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
        $this->setMessage($this->codes[$this->getCode()]);
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
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
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
