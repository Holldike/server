<?php

class Connect {
    private $id;
	private $ip;
	private $port;
	public $resource;

	public function __construct(int $id, $resource) {
		socket_getpeername($resource, $ip, $port);
		$this->resource = $resource;
		$this->id = $id;
		$this->ip = $ip;
		$this->port = $port;
	}

	public function getPort(): int {
		return $this->port;
	}

	public function getIp(): string {
		return $this->ip;
	}

    public function getId(): string {
        return $this->id;
    }

	public function updateBuffer($message) {
		$this->write($message);
	}

	public function write($message) {
		socket_write($this->resource, $message, strlen($message));
	}

	public function getMessage() {
		if ($buf = socket_read($this->resource, 2048)) {
			return $buf;
		} else {
			return false;
		}
	}
}	
