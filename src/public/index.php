<?php

require('../vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\SocketHandler;

// create a log channel
$log = new Logger('elk');

// "logstash" is a host defined by docker-compose
$handler = new SocketHandler('logstash:9001', Logger::DEBUG);
$log->pushHandler($handler);

// log the details of the user visit
$visitDetails = [
    'ip' => $_SERVER['REMOTE_ADDR'],
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => $_SERVER['REQUEST_URI'],
    'agent' => $_SERVER['HTTP_USER_AGENT'],
    'referer' => $_SERVER['HTTP_REFERER'] ?? 'not set'
];
$log->info("Example of a request being logged", $visitDetails);

echo "Pushed message to Logstash.";