<?php
namespace Lib\MessageQueue;

/**
 * 消息生产者
 *
 *@author ldy
 */
class MessageProducer 
{
	use QueueTrait;

	public $delay=0;
	/**
	*@param array
	*@param string
	*/
	function  __construct($config)
	{
		$this->connect($config);
	}

	/**
	*发布一条消息到指定队列
	*	
	*@param  string   
	*@param  string    
	*@param  int 
	*
	*@return  true|throw exception
	*
	*/
	public function publish($queueName, $message)
	{
		//发布消息
		try {
			$this->redis->zAdd($queueName, $this->getTimeSort($this->delay), $message);
			return true;
		} catch (\RedisException $e) {
			throw $e;
		} catch (\ErrorException $e) {
			throw $e;			
		}

	}

}







