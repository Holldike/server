<?php
require __DIR__ . '/vendor/autoload.php';

const APPLICATION_DIR = __DIR__;

set_time_limit(0);

const ADDRESS = '127.0.0.1';
const PORT = 8081;

$logger = new Logger(/*path to logger file */ APPLICATION_DIR . '/storage/logs.txt');

$server = new Server($logger);
$server->listen(ADDRESS, PORT);
