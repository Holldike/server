<?php
require __DIR__ . '/vendor/autoload.php';

const APPLICATION_DIR = __DIR__;

set_time_limit(0);

const ADDRESS = '0.0.0.0';
const PORT = 80;

$core = new Core();
if ($core->initConnect()) {
    $core->acceptConnect();
}
