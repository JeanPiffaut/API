<?php

class endpoint_result
{
    public endpoint_header $header;
    public endpoint_response|array $response = [];

    /**
     * Endpoit_Result consturctor. This requires as a basis the response code to be given to the client as it is
     * very important in the response process.
     * @param $code
     */
    public function __construct($code)
    {
        $this->setHeader($code);
    }

    /**
     * Configure the header of the API response in which we will find the code and a message indicating
     * how the call was made.
     * @param string|int $code
     */
    public function setHeader(string|int $code): void
    {
        $this->header = new endpoint_header((int)$code);
    }

    /**
     * Configure the response that the API gives you with all the content you require.
     * @param $key
     * @param $sub_key
     */
    public function setResponse($key, $sub_key): void
    {
        if(is_array($this->response) === true) {

            $this->response = new endpoint_response();
        }

        $this->response->setContent($key, $sub_key);
    }

    /**
     * Configures the errors that have been generated in the request made.
     * @param mixed $errors
     */
    public function setError(mixed $errors): void
    {
        if(isset($this->errors) === false) {

            $this->errors = array();
        }

        $this->errors[] = $errors;
    }

    /**
     * Configures the errors that PHP generated during the request.
     */
    public function setHandlerResult(): void
    {
        global $HANDLER_ERROR, $CONFIG;
        if(isset($HANDLER_ERROR) && empty($HANDLER_ERROR) === false && $CONFIG['project']['debug'] === true) {

            $this->setError($HANDLER_ERROR);
            $HANDLER_ERROR = array();
        }
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

    /**
     * Constructor in charge of receiving and configuring the API response code and the message that accompanies it.
     * @param int $code
     */
    public function __construct(int $code)
    {
        $this->setCode($code);
        $this->setMessage($this->codes[$this->code]);
    }

    /**
     * Configure the response code
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * Configure the response message
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}

class endpoint_response
{
    /**
     * Configures the content of the "response" section, within the entire API response.
     * @param string $key
     * @param mixed $sub_key
     */
    public function setContent(string $key, mixed $sub_key): void
    {
        $this->$key = $sub_key;
    }
}
