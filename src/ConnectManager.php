<?php

class ConnectManager {
	private $sock;
	private $address;
	private $port;
	private $handler;

	public function __construct($address, $port, ConnectHandler $handler) {
		$this->address = $address;
		$this->port = $port;
		$this->handler = $handler;
	}

	public function init() {
			if (($this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false ||
				socket_bind($this->sock, $this->address, $this->port) === false || 
				socket_listen($this->sock) === false) 
					die('Initilization error');
	}

	public function listen() {
	    $connectId = 0;

		while (true) {
			if ($connect = new Connect($connectId, socket_accept($this->sock))) {
				$this->handler->setConnect($connect);
				if ($this->handler->handle() && $this->handler->createProccess()) $connectId++;
			}
		}
	}
}
