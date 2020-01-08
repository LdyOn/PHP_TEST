<?php
namespace Lib\MessageQueue;

/**
 * 消息生产者
 *
 *@author ldy
 */
trait QueueTrait 
{
	//2019-12-1
	protected $baseTime = 1575129600;
	//Redis实例
	private $redis = null;
	//消息队列名称
	protected  $queueName;

	/**
	*设置队列名称
	*@param string $queueName
	*/
	public function setQueueName($queueName)
	{
		$this->queueName = $queueName;
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

	/**
	*排序权重
	*
	*@param int 
	*/
	public function getTimeSort($delay=0)
	{
		return  time() - $this->baseTime + $delay;
	}

}




