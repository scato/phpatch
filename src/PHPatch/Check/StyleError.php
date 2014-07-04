<?php


namespace PHPatch\Check;


class StyleError
{
    /**
     * @var string
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
     * @param string $filename
     * @param integer $line
     * @param integer $char
     * @param string $message
     */
    public function __construct($filename, $line, $char, $message)
    {
        $this->filename = $filename;
        $this->line = $line;
        $this->char = $char;
        $this->message = $message;
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
