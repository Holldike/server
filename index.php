<?php
require __DIR__ . '/vendor/autoload.php';

const APPLICATION_DIR = __DIR__;

set_time_limit(0);

const ADDRESS = '0.0.0.0';
const PORT = 8080;

$logger = new Logger(APPLICATION_DIR . '/storage/logs.txt');

$server = new Server($logger);
$server->listen(ADDRESS, PORT);