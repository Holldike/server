<?php 

require 'vendor/autoload.php';

set_time_limit(0);

//connect const
const ADDRESS = '0.0.0.0';
const PORT = 8080;

//application const
const APPLICATION_DIR = __DIR__;
const STORAGE_DIR = APPLICATION_DIR . '/storage/';
const LOG_DIR = STORAGE_DIR . '/logs/';

$logger = new Logger(LOG_DIR);

$messenger = new Messenger();

$mailer = new Mailer();

$connectHandler = new ConnectHandler($logger, $messenger, $mailer);

$connectManager = new ConnectManager(
	ADDRESS, PORT, $connectHandler
);
$connectManager->init();
$connectManager->listen();
