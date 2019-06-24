<?php

/************************************************************
 享元模式（Flyweight Pattern）主要用于减少创建对象的数量，以减少内存占用和提高性能。这种类型的设计模式属于结构型模式，它提供了减少对象数量从而改善应用所需的对象结构的方式。
享元模式尝试重用现有的同类对象，如果未找到匹配的对象，则创建新对象。我们将通过创建 5 个对象来画出 20 个分布于不同位置的圆来演示这种模式。由于只有 5 种可用的颜色，所以 color 属性被用来检查现有的 Circle 对象。
 ************************************************************/
namespace Lib\ObjectDesign;

class  FlyweightPatternDemo
{
	
	function __construct()
	{
		
	}

	public function test($value='')
	{
		$colors = ["blue","red","green","black","white"];
		for ($i=0; $i < 20; $i++) { 
			$circle = ShapeFactory::getCircle($colors[rand(0,4)]);
			$circle->setX(rand(1,100));
			$circle->setY(rand(1,100));
			$circle->setRadius(100);
			$circle->draw();
		}
	}

}

interface Shape{
	function draw();
}
/**
 * 
 */
class Circle  implements Shape
{
	private $x,$y,$radius;
	private $color;

	function __construct($color)
	{
		$this->color = $color;
	}

	public function setX($value='')
	{
		$this->x = $value;
	}

	public function setY($value='')
	{
		$this->y = $value;
	}

	public function setRadius($radius) {
       $this->radius = $radius;
   	}

   	public function draw($value='')
   	{
   		echo "Circle draw, color:".$this->color.",x:".$this->x.",y:".$this->y.",radius:".$this->radius."<br>";
   	}

}


/**
 * 
 */
class ShapeFactory 
{
	private static $map=[];	

	function __construct()
	{
		# code...
	}

	public static function getCircle($color)
	{
		if(array_key_exists($color, static::$map))
			return static::$map[$color];
		return static::$map[$color] = new Circle($color);
	}
}

