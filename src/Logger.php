<?php

class Logger {
	private $logDir;
	private $errorFile = 'error';
	private $logFile = 'log';

	public function __construct(string $logDir) {
		$this->logDir = $logDir;
	}

	public function write(string $file, string $message) {
        $time = date('d.n | H:i:s');
		$message = "date($time) " . $message . "\n";
		$path2File = $this->logDir . $file;

		if (file_exists($path2File)) {
			file_put_contents($path2File, $message, FILE_APPEND);
			echo $message;
		} else {
            throw new Exception("The log file $path2File don't exists");
        }
	}
	
	public function writeError(string $message) {
		$this->write($this->errorFile, $message);
	}
	
	public function writeLog(string $message) {
		$this->write($this->logFile, $message);
	}
}
