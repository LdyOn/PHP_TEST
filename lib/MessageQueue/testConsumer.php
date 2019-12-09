#!/usr/bin/php
<?php

require './MessageConsumer.php';
//创建一个闭包来处理消息
$handler = function($message){
	$f = fopen('message.log', 'a+');
	fwrite($f, '['.date('Y-m-d H:i:s').'] Got message:'.$message."\n");
};
$consumer = new MessageConsumer('my-queue', $handler);
$consumer->connect([
	'host' => '127.0.0.1',
	'port' => 6379,
]);


$consumer->run();




