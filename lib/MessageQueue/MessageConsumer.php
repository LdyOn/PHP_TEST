<?php

/**
 *消费者
 *
 *@author ldy 
 */
class MessageConsumer 
{
	//Redis实例
	private $redis = null;
	//队列名称
	protected  $queueName;
	//设置消息处理器
	protected $handler;

	/**
	*
	*@param string $queueName
	*@param object|\Closure $handler
	*/
	function __construct($queueName, $handler)
	{
		$this->queueName = $queueName;
		$this->handler  = $handler;
	}


	/**
	*设置队列名称
	*@param string $queueName
	*/
	public function setQueueName($queueName)
	{
		$this->queueName = $queueName;
	}


	/**
	*设置消息处理器
	*@param object|\Closure $handler
	*/
	public function setHandler($handler)
	{
		$this->handler = $handler;
	}

	/**
	*连接redis服务器
	*
	*@param array $config redis连接配置
	*/
	public function connect($config)
	{
		$this->redis = new \Redis;

		$this->redis->connect($config['host'], $config['port']);

		if(isset($config['password']) && !empty($config['password'])){
			$this->redis->auth($config['password']);
		}

		if(isset($config['db']) && !empty($config['db'])){
			$this->redis->select($config['db']);
		}

	}

	/*处理消息*/
	public function consume()
	{
		//从队列中取出最早的一条消息
		$message = $this->redis->rPop($this->queueName);

		if($message===false)
			return;
		//转换回数组格式
		$message = json_decode($message, true);

		//如果消息已经过期，则丢弃不做处理
		if($message['expireAt'] != null && time()>$message['expireAt'])
			return ;

		if($this->handler  instanceof \Closure){
			call_user_func($this->handler, $message['message']);
		}elseif(is_object($this->handler)){
			$this->handler->handle($message['message']);
		}else{
			throw new Exception("消息处理器类型错误，消息处理器是一个对象或闭包", 1);
			
		}
	}


	/*运行消息消费者*/
	public function run()
	{
		// 让脚本一直运行
		while (true) {
			$this->consume();
			//每隔五秒读取消息进行处理
			sleep(5);
		}
	}


	
}




