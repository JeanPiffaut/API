<?php

namespace Directory;

use endpoint_result;

global $HANDLER_ERROR;
$HANDLER_ERROR = array();

/**
 * Function in charge of generating and applying the error to be displayed according to what the system requires.
 * @param int $number
 * @param string $message
 * @param string|null $file
 * @param int|null $line
 * @param array|null $context
 * @return bool
 */
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

    /**
     * Constructor of the error handler that has been generated, which is responsible for collecting all
     * the information that PHP gives us about the errors that occur.
     * @param int $number
     * @param string $message
     * @param string|null $file
     * @param int|null $line
     * @param array|null $context
     */
    public function __construct(int $number, string $message, string|null $file = null, int|null $line = null,
                                array|null $context = null)
    {
        $this->setNumber($number);
        $this->setMessage($message);
        $this->setFile($file);
        $this->setLine($line);
        $this->setContext($context);
    }

    public function setError(): void
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
                if(E_WARNING === $this->number) {

                    $type = "WARNING";
                } elseif(E_NOTICE === $this->number) {

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
     * @param int $code
     * @param array $contents
     * @return endpoint_result
     */
    private function setResult(int $code, array $contents = array()): endpoint_result
    {
        $result = new endpoint_result($code);

        foreach ($contents as $key => $content) {

            $result->setResponse($key, $content);
        }

        return $result;
    }

    /**
     * Returns the number or type of error that occurred.
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Sets the number or type of error generated.
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * Returns the message that the error generated.
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
     * Configures the message that the error generated.
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Returns the file in which the error was generated
     * @return string|null
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * Configures the file in which the error was generated.
     * @param string|null $file
     */
    public function setFile(?string $file): void
    {
        $this->file = $file;
    }

    /**
     * Returns the line where the error occurred.
     * @return int|null
     */
    public function getLine(): ?int
    {
        return $this->line;
    }

    /**
     * Sets the line where the error occurred.
     * @param int|null $line
     */
    public function setLine(?int $line): void
    {
        $this->line = $line;
    }

    /**
     * Returns the context in which the error was generated.
     * @return array|null
     */
    public function getContext(): ?array
    {
        return $this->context;
    }

    /**
     * Sets the context in which the error was generated.
     * @param array|null $context
     */
    public function setContext(?array $context): void
    {
        $this->context = $context;
    }
}
