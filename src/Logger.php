<?php


class Logger implements LoggerInterface
{
	/**
	* @var string
	*/
	private $path;
	
	public function __construct(string $path)
	{
		$this->path = $path;
	}

    public function write(string $message): void
    {
        $file = fopen($this->path, 'w+');
        fwrite($file, $this->buildMessage($message));
        fclose($file);
    }

    private function buildMessage(string $message): string
    {
        $time = date('d.n H:i:s');

        return "$time | $message";
    }
}
