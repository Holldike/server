<?php

class Core
{
    private $sock;
    private $conn;

    public function initConnect()
    {
        if (!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) ||
            !(socket_bind($sock, ADDRESS, PORT)) ||
            !(socket_listen($sock, 5))
        ) {
            return 0;
        } else {
            echo "Initialization Successful \n";
            return $this->sock = $sock;
        }
    }

    public function handle()
    {
        if (!$this->conn) return 0;

        $response = require 'http.php';

        socket_write($this->conn, $response, strlen($response));

        socket_getpeername($this->conn, $address, $port);
		
		stream_set_blocking($this->conn, false);	
		
        Logger::writeSocketData($address, $port);

        if ($this->conn) socket_close($this->conn);
    }

    public function acceptConnect()
    {
        while (1) {
            $this->handle();
            if (!($this->conn = socket_accept($this->sock))) {
                return 0;
            }
            $this->acceptConnect();
        };
    }
}
