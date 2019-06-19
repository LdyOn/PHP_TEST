<?php

/*********************************************
 原型模式（Prototype Pattern）是用于创建
 重复的对象，同时又能保证性能。这种类型的设计
 模式属于创建型模式，它提供了一种创建对象的最佳方式。
 ***********************************************/

namespace Lib\ObjectDesign;

/*
*
*/
class Prototype 
{
	protected $conenction;

	protected $object;
	
	function __construct()
	{
		
	}

	//数据库连接
	public function connect(array $config)
	{
		# code...
	}

	//定义魔术方法
	function __clone(){

		/* 当用clone克隆一个prototype对象时，$connection
		数据库连接将被复用，同时强制复制一份this->object， 否则仍然指向同一个对象（被拷贝的对象的object属性）*/
		$this->object = clone $object;
	}


}



