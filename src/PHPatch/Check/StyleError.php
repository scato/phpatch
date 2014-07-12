<?php


namespace PHPatch\Check;


class StyleError
{
    /**
     * @var string|null
     */
    private $filename;

    /**
     * @var integer
     */
    private $line;

    /**
     * @var integer
     */
    private $char;

    /**
     * @var string
     */
    private $message;

    /**
     * @param string $message
     * @param integer $line
     * @param integer $char
     * @param string|null $filename
     */
    public function __construct($message, $line, $char, $filename = null)
    {
        $this->message = $message;
        $this->line = $line;
        $this->char = $char;
        $this->filename = $filename;
    }

    /**
     * @return integer
     */
    public function getChar()
    {
        return $this->char;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return integer
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
