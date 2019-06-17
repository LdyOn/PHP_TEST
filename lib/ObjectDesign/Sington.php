<?php

/**************************************************
 * 单例模式，所有需要用到类Sington的地方都调用getInstance方法获取
 ****************************************************/

namespace Lib\ObjectDesign;

class Sington 
{
	//定义一个静态实例
	private static $instance=null;

	//将构造函数声明为私有
	private function __construct(){
		
	}

	//获取单一实例的唯一方法
	public static function getInstance(){
		if(static::$instance)
			return static::$instance;
		return static::$instance = new static;
	}

	public function uName($value='')
	{
		echo get_class();
	}
}