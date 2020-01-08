<?php
namespace Lib\MessageQueue;
/**
 *消费者
 *
 *@author ldy 
 */
class MessageConsumer 
{
	use QueueTrait;

	protected $handler;
	/**
	*
	*@param string $queueName
	*@param object|\Closure $handler
	*@param array
	*/
	function __construct($queueName, $handler, $config)
	{
		$this->queueName = $queueName;
		$this->handler = $handler;
		$this->connect($config);
	}

	/**
	*设置消息处理器
	*@param object|\Closure $handler
	*/
	public function setHandler($handler)
	{
		$this->handler = $handler;
	}


	/*处理消息*/
	public function consume()
	{
		$scoreNow = $this->getTimeSort();
		//从队列中取出到了执行时间的数据
		$ret = $this->redis->multi()->zRangeByScore($this->queueName, 0, $scoreNow)->zRemRangeByScore($this->queueName, 0, $scoreNow)->exec();
		$messages = $ret[0];
		
		foreach ($messages as $value) {
			$value = json_decode($value, true);
			if($this->handler instanceof \Closure){
				call_user_func_array($this->handler, $value);
			}elseif(is_object($this->handler)){
				$this->handler->handle($value);
			}else{
				throw new Exception("处理器必须是对象或闭包", 1);
				
			}
		}
	}




	/*运行消息消费者*/
	public function run()
	{
		// 让脚本一直运行
		while (true) {
			$this->consume();
			//暂停一秒
			sleep(1);
		}
	}


	
}




