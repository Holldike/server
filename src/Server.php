<?php

class Server
{
    private $sockets;

    public function listen(string $address, int $port): void
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if (!$socket ||
            !(socket_bind($socket, $address, $port)) ||
            !(socket_listen($socket, 5))
        ) {
            throw new Exception('Listen: error init connect');
        }

        while (true) {
//            if ($connection = socket_accept($socket)) $this->sockets[] = $connection;
//
//            var_dump($this->sockets);
            $start_time = time();

            while(true) {
                $test = (time() - $start_time);
                echo $test;
                if ($test > 2) {
                    break;
                }
            }

//            if (!empty($this->sockets)) {
//
//                $write  = NULL;
//                $except = NULL;
//                $num_changed_sockets = socket_select($write, $this->sockets, $except, 4);
//
//                echo $num_changed_sockets;
//            }



//            while (true) {
//                $buf = socket_read($connection, 1024);
//                socket_write($connection, $buf, strlen($buf));
//                break;
//            }
        }

    }

}
