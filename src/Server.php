<?php

class Server
{
    private $sockets;
	private $logger;
	public function __construct($logger)
	{
		$this->logger = $logger;
	}
    public function listen(string $address, int $port): void
    {
		try {
	        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			socket_bind($socket, $address, $port); 
   	        socket_listen($socket, 5);
		} catch(Exception $e) {
			$this->logger->buildError($e->getMessage());
			$this->logger->write();
		}
		
		echo posix_getppid();
		echo getmypid();
        while (true) {
            if ($connection = socket_accept($socket)) {
				if (!isset($break)) $break = 0;

				$this->logger->buildMessage(getmypid());
				$this->logger->write();

           	    while (true) {
                	$buf = socket_read($connection, 1024);
                	socket_write($connection, $buf, strlen($buf));
					if (posix_getppid()) break;
           		}
		   		Forker::doFork();
			} 
        }
    }
}
