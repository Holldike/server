<?php

class Server
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function listen(string $address, int $port): void
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if (!$socket ||
            !(socket_bind($socket, $address, $port)) ||
            !(socket_listen($socket))
        ) {
            throw new Exception('Listen: error init connect');
        }

        while (true) {
            $connection = socket_accept($socket);

            $httpResponseBuilder = new HttpResponseBuilder();
            $httpResponseBuilder->setBody();
            $httpResponseBuilder->setCode();

            $response = $this->getResponse();
            socket_write($connection, $response, strlen($response));
            socket_close($connection);
        }
    }

    private function getResponse(): string
    {
        return "HTTP/1.1 200 OK\n\n<h1 style='text-align: center'>HOLLDIKE SERVER</h1>";
    }

}
