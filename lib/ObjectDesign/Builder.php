<?php


/*****************************************
 * 创建者模式，实现一个构建器类，从构建器获取
 *想要的对象组合
 *****************************************/

namespace Lib\ObjectDesign;

/*
*创建三餐构建器
*/
class MealBuilder
{
	
	function __construct()
	{
		
	}

	//准备午餐
	public function prepareLaunch()
	{
		$meal = new Meal();
		$meal->setFood(new Apple(1.9,2));
		$meal->setFood(new Beer(5,1));

		return $meal;
	}

	//准备晚餐
	public function prepareDinner()
	{
		$meal = new Meal();
		$meal->setFood(new FiredChicken(10,5));
		$meal->setFood(new Beer(5,1));

		return $meal;
	}

}

/**
 * Meal类
 */
class Meal 
{
	protected $foods = [];
	
	function __construct()
	{
		
	}

	public function setFood(Food $food)
	{
		$this->foods[] = $food;
	}

	public function getFood()
	{
		return $this->foods;
	}

	public function caculatePrice()
	{
		return (float)array_reduce($this->foods, function($sum,$food){
			return $sum + $food->getPrice()*$food->getNums();
		},0);
	}

}

/**
 * Food接口
 */
interface Food 
{
	protected $name;//名称

	protected $state;//状态，固液气

	protected $price;//价格

	protected $packing;//包装

	protected $nums;//数量


	public function getName();

	public function getPrice();

	public function getPacking();

	public function getState();

	public function getNums();

	public function setName($name);

	public function setPrice($price);

	public function setPacking(Packing $packing);

	public function setState($state);

	public function setNums($state);

}

interface Packing{

}

/**
 * 苹果类
 */
class Apple implements Food 
{
	protected $name;//名称

	protected $state;//状态，固液气

	protected $price;//价格

	protected $packing;//包装

	protected $nums;//数量
	
	function __construct($price,$nums)
	{
		$this->name = 'apple';
		$this->price = $price;
		$this->nums = $this->nums;
	}

	//方法省略

}

/**
 * 炸鸡类
 */
class FiredChicken implements Food 
{
	protected $name;//名称

	protected $state;//状态，固液气

	protected $price;//价格

	protected $packing;//包装
	
	function __construct($price,$nums)
	{
		$this->name = 'fried_checken';
		$this->price = $price;
		$this->nums = $this->nums;
	}

	//方法省略

}

/**
 * 啤酒类
 */
class Beer implements Food 
{
	
	protected $name;//名称

	protected $state;//状态，固液气

	protected $price;//价格

	protected $packing;//包装
	
	function __construct($price,$nums)
	{
		$this->name = 'beer';
		$this->price = $price;
		$this->nums = $this->nums;
		$this->state = 'liquid';
		$this->packing = new Bottle;
	}

	//方法省略
}


//创建构建器
$meal_builder = new MealBuilder;
//获取一份午餐
$meal = $meal_builder->prepareLaunch();

$foods = $meal->getFood();

var_dump($foods);

