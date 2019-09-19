<?php


class Logger
{
    const FILE = APPLICATION_DIR . '/storage/logs.txt';

    public static function writeSocketData($address, $port)
    {
        $file = fopen(self::FILE, 'a+');
        fwrite($file, self::buildItem($address, $port));
        fclose($file);
    }

    private static function buildItem($address, $port)
    {
        $time = date('d.n H:i:s');
        return
            "$time | ip: $address | port: $port\n";
    }
}
