<?php

#所有需要用到类Sington的地方都调用getInstance方法获取
/**
 * 
 */
class Sington 
{
	
	private static $instance=null;

	public static function getInstance(){
		if($this->instance)
			return $this->instance;
		return $this->instance = new static;
	}
}