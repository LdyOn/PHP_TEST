<?php

/************************************************************
在代理模式（Proxy Pattern）中，一个类代表另一个类的功能。这种类型的设计模式属于结构型模式。
在代理模式中，我们创建具有现有对象的对象，以便向外界提供功能接口。
 ************************************************************/
namespace Lib\ObjectDesign;

class  ProxyPatternDemo
{


}


interface Image{
	public function display();
	
}

/**
 * 
 */
class  RealImage implements Image 
{
	private $file_name;

	function __construct($file_name)
	{
		$this->file_name = $file_name;
		$this->loadFromDisk($this->file_name);
	}

	public function display()
	{
		echo "display image ".$this->file_name;
	}

	private function loadFromDisk($file_name)
	{
		echo "load image from disk.";
	}


}


/**
 * 
 */
class ProxyImage implements Image 
{
	private $file_name;
	private $real_image;

	function __construct($file_name)
	{
		$this->file_name = $file_name;
	}

	public function display()
	{
		if($this->real_image==null)
			$this->real_image = new RealImage($this->file_name);
		$this->real_image->display();
	}
}




































