<?php

class Logger 
{
	/**
	* @var string
	*/
	private $path;
	private $message;
	public function __construct(string $path)
	{
		$this->path = $path;
	}

    public function write()
    {
		file_put_contents($this->path, $this->message, FILE_APPEND);
    }

    public function buildMessage(string $message)
    {
        $time = date('d.n H:i:s');
        $this->message = "$time | $message" . "\n";
    }

    public function buildError(string $message)
    {
        $this->message = "ERROR | $message" . "\n";
    }
}
