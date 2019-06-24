<?php

/****************************************************************
 装饰器模式（Decorator Pattern）允许向一个现有的对象添加新的功能，同时又
 不改变其结构。这种类型的设计模式属于结构型模式，它是作为现有的类的一个包装。这种模式创建了一个装饰类，用来包装原有的类，并在保持类方法签名完整性的前提下，提供了额外的功能。 
 ***************************************************************/
namespace Lib\ObjectDesign;

class DecoratorPattenDemo 
{
	
	function __construct()
	{
		
	}

	public function test()
	{
		$redCircle = new RedShapeDecorator(new Circle());
		$redCircle->draw();

		$redRectangle = new RedShapeDecorator(new Rectangle());
		$redRectangle->draw();
	}
}

interface  Shape{
	public function draw();	
}

/**
 * 
 */
class Circle implements Shape
{
	
	function __construct()
	{
		# code...
	}

	public function draw()
	{
		print("a circle shape");
	}
}

/**
 * 
 */
class  Rectangle  implements Shape
{
	
	function __construct()
	{
		# code...
	}

	public function draw()
	{
		print("a Rectangle shape");
	}
}

//创建 一个装饰器类
/**
 * 
 */
abstract class ShapeDecorator implements Shape
{
	protected $shape;

	function __construct(Shape $shape)
	{
		$this->shape = $shape;
	}

 	public function draw()
 	{
 		$this->shape->draw();
 	}
}

/**
 * 
 */
class RedShapeDecorator extends ShapeDecorator
{
	
	function __construct(Shape $shape)
	{
		parent::__construct($shape);
	}

	public function draw()
	{
		$this->shape->draw();
		$this->setRedBorder($this->shape);
	}

	private function setRedBorder($shape)
	{
		print("set red border");
	}

}