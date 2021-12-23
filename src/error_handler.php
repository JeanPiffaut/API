<?php

namespace Directory;

use endpoint_result;

global $HANDLER_ERROR;
$HANDLER_ERROR = array();

function api_error_handler(int $number, string $message, string|null $file = null, int|null $line = null, array|null $context = null): bool
{
    $handler = new Error_Handler($number, $message, $file, $line, $context);
    $handler->setError();

    return true;
}

class Error_Handler
{
    private int $number;
    private string $message;
    private string|null $file = null;
    private int|null $line = null;
    private array|null $context = null;

    public function __construct(int $number, string $message, string|null $file = null, int|null $line = null, array|null $context = null)
    {
        $this->setNumber($number);
        $this->setMessage($message);
        $this->setFile($file);
        $this->setLine($line);
        $this->setContext($context);
    }

    public function setError()
    {
        global $CONFIG;
        if($CONFIG['project']['debug'] === true) {

            $this->debugError();
        } else {

            $this->internalError();
        }
    }

    /**
     * This function must be configured according to the system requirements to send the errors by mail or
     * return them in any convenient way.
     */
    private function internalError(): void
    {

    }

    /**
     * Error system for when the project is in debug mode
     */
    private function debugError(): void
    {
        switch ($this->number) {
            case E_PARSE:
                $result = $this->setResult(500, [
                    "type" => "PARSE",
                    "message" => $this->getMessage(),
                    "context" => $this->getContext(),
                ]);
                print json_encode($result);
                exit();
            default:
                if(E_WARNING == $this->number) {

                    $type = "WARNING";
                } elseif(E_NOTICE == $this->number) {

                    $type = "NOTICE";
                } else {

                    $type = "ERROR";
                }

                global $HANDLER_ERROR;
                $HANDLER_ERROR[] = [
                    "type" => $type,
                    "message" => $this->getMessage(),
                    "context" => $this->getContext(),
                ];
                break;
        }
    }

    /**
     * Configures the result that will be obtained from the endpoint.
     * @param $code
     * @param array $contents
     * @return endpoint_result
     */
    private function setResult($code, array $contents = array()): endpoint_result
    {
        $result = new endpoint_result($code);

        foreach ($contents as $key => $content) {

            $result->setRequest($key, $content);
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        $message = $this->message;
        if($this->file !== null) {

            $message .= " - " . $this->getFile();
        }

        if ($this->line !== null) {

            $message .= " - " . $this->getLine();
        }

        return $message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * @param string|null $file
     */
    public function setFile(?string $file): void
    {
        $this->file = $file;
    }

    /**
     * @return int|null
     */
    public function getLine(): ?int
    {
        return $this->line;
    }

    /**
     * @param int|null $line
     */
    public function setLine(?int $line): void
    {
        $this->line = $line;
    }

    /**
     * @return array|null
     */
    public function getContext(): ?array
    {
        return $this->context;
    }

    /**
     * @param array|null $context
     */
    public function setContext(?array $context): void
    {
        $this->context = $context;
    }
}
