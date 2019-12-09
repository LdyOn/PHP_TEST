<?php

/**
 * 消息生产者
 *
 *@author ldy
 */
class MessageProducer 
{
	//Redis实例
	private $redis = null;


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

	/**
	*发布一条消息到指定队列
	*
	*@param  string  $queueName  队列名称
	*@param  string  $message  消息
	*@param  int  $expireAt  过期时间，unix秒级时间戳
	*
	*@return  true|throw exception
	*
	*/
	public function publish($queueName, $message, $expireAt=null)
	{
		$message = array(
			'message' => $message,
			'expireAt' => $expireAt,
			'publishAt' => time(),
		);

		//redis的列表结构只能保存字符串数据，这里将message数组 转换成json格式
		$message = json_encode($message);
		//发布消息到redis队列
		try {
			$this->redis->lPush($queueName, $message);
			return true;
		} catch (\RedisException $e) {
			return false;
		} catch (\ErrorException $e) {
			throw $e;			
		}

	}



}



