<?php

/************************************************************
 外观模式（Facade Pattern）隐藏系统的复杂性，并向客户端提供了一个客户端可以访问系统的接口。这种类型的设计模式属于结构型模式，它向现有的系统添加一个接口，来隐藏系统的复杂性。这种模式涉及到一个单一的类，该类提供了客户端请求的简化方法和对现有系统类方法的委托调用。
 ************************************************************/
namespace Lib\ObjectDesign;

class  FacadePatternDemo
{
	
	function __construct()
	{
		
	}
}


interface Shape{
	public function draw();
	
}

/**
 * 
 */
class Rectangle  implements Shape
{
	
	function __construct()
	{
		# code...
	}

	public function draw()
	{
		echo "draw a rectangle";
	}

}

/**
 * 
 */
class Circle implements Shape
{
	
	function __construct()
	{
	}

	public function draw()
	{
		echo "draw a circle";
	}

}


class Square implements Shape {
 
   
   public function draw() {
      print("Square::draw()");
   }
}


/**
 * 
 */
class ShapMaker
{
	private $circle;
	private $rectangle;
	private $square;

	function __construct()
	{
		$this->circle = new Circle();
		$this->rectangle = new Rectangle();
		$this->square = new Square();
	}

	public function drawCircle(){
    	$this->circle->draw();
   	}
	public function drawRectangle(){
    	$this->rectangle->draw();
    }
    public function drawSquare(){
    	$this->square->draw();
    }

}






























































