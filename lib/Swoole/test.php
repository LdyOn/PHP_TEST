<?php
require_once 'TcpServer.php';

$server = new  \Lib\Swoole\TcpServer();

// 定义连接建立回调函数
$server->onConnect = function ($conn) {
    echo "onConnect -- accepted " . stream_socket_get_name($conn, true) . "\n";
};

// 定义收到消息回调函数
$server->onMessage = function ($conn, $msg) {
    echo "onMessage --" . $msg . "\n";
    fwrite($conn, "received " . $msg . "\n");
};

// 定义连接关闭回调函数
$server->onClose = function ($conn) {
    echo "onClose --" . stream_socket_get_name($conn, true) . "\n";
};

// 启动服务器主进程
$server->run();

