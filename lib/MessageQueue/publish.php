#!/usr/bin/php
<?php

require  './MessageProducer.php';

$producer = new MessageProducer();
$producer->connect([
	'host' => '127.0.0.1',
	'port' => 6379,
]);
$producer->publish('my-queue', 'You sad hello world!');










