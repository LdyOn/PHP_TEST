<?php

class WebsocketServer {
    public $server;
    public function __construct() {
        $this->server = new Swoole\WebSocket\Server("0.0.0.0", 9502);
        $this->server->on('open', function (swoole_websocket_server $server, $request) {
          	$redis = new \Redis;
            $redis->connect('127.0.0.1',6379);
            //建立连接之后保存该客户端标识符
            $redis->lPush('server_list',$request->fd);
            //获取一个客户
            if($to=$redis->rPop('client_list')){
            	//输出消息到客户端
            	
            }
        });
        $this->server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
            // echo $frame->fd;
            $redis = new \Redis;
            $redis->connect('127.0.0.1',6379);
            //获取客服
            if($to = $redis->get("cli-sendto".$frame->fd)){
            	$server->push($to, $frame->data);
            }elseif($to = $redis->){
            	$redis->lPush('client_message_'.$frame->fd, $frame->data);
            }
            
            // $server->push($frame->fd, "this is server");
        });
        $this->server->on('close', function ($ser, $fd) {
            
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

new Websocket();