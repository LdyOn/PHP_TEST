<?php

class WebsocketClient {
    public $server;
    public function __construct() {
        $this->server = new Swoole\WebSocket\Server("0.0.0.0", 9501);
        $this->server->on('open', function (swoole_websocket_server $server, $request) {

        });
        $this->server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
            $message = explode(':', trim($frame->data));
            $redis = new \Redis;
            $redis->connect('127.0.0.1',6379);
            //初始连接接收对方 的消息
            if($message[2]==='connect'){
            	$server->push($frame->fd,'系统消息：连接已建立......');
            	$msg_array = $redis->lRange("msg_by_".$message[1],0,-1);
            	foreach ($msg_array as $key => $value) {
            		$server->push($request->fd,$value);
            	}
            	$redis->set($message[0],$frame->fd);
            	$redis->set($frame->fd,$message[0]);
            	$redis->delete("msg_by_".$message[1]);
            	return;
            }
            //发送消息,对方在线则发送
            if($to = $redis->get($message[1])){
            	$server->push($to, $message[2]);
            }else{
            	$redis->rPush("msg_by_".$message[1],$message[2]);
            }

        });
        $this->server->on('close', function ($ser, $fd) {
            $redis = new \Redis;
            $redis->connect('127.0.0.1',6379);
            $name = $redis->get($fd);
            $redis->delete($name,$fd);
        });
        $this->server->on('request', function ($request, $response) {
            // 接收http请求从get获取message参数的值，给用户推送
            // $this->server->connections 遍历所有websocket连接用户的fd，给所有用户推送
            foreach ($this->server->connections as $fd) {
                // 需要先判断是否是正确的websocket连接，否则有可能会push失败
                if ($this->server->isEstablished($fd)) {
                    $this->server->push($fd, $request->get['message']);
                }
            }
        });
        $this->server->start();
    }
}

new WebsocketClient();