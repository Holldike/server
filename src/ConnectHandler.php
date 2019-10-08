<?php

class ConnectHandler {
	private $logger;
	private $messenger;
	private $mailer;
	private $connect;

	public function __construct(Logger $logger, Messenger $messenger, Mailer $mailer) {
		$this->logger = $logger;
		$this->messenger = $messenger;
		$this->mailer = $mailer;
	}

	public function setConnect(Connect $connect) {
		$this->connect = $connect;
	}

	public function handle() {
		$this->mailer->addConnect($this->connect);
		$ip = $this->connect->getIp();
		$port = $this->connect->getPort();

		$this->logger->writeLog("ip:$ip| port:$port");
		return true;
	}
	
	public function createProccess() {
		$pid = pcntl_fork();

		if ($pid == -1) 
			die('fork error');
		if ($pid === 0) 
			$this->circulateConnection();
		return true;
	}

	public function circulateConnection() {
        $id = $this->connect->getId();
        $ip = $this->connect->getPort();
		$port = $this->connect->getPort();
		$messageHead = $ip . '|> ';

		$this->connect->write($this->messenger->getGreeting());

		while (true) {
			$this->connect->write($messageHead);	
			if ($message = $this->connect->getMessage()) {
				$message = $messageHead . $message;
				$this->mailer->sendOut([
				    'connect_id' => $id,
                    'body' => $message
                ]);
			} else {
				$this->logger->writeError("connection with $ip|$port lost");
				break;
			}
		}
	}
}
		
