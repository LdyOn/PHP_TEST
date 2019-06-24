<?php

/****************************************************************
在空对象模式（Null Object Pattern）中，一个空对象取代 NULL 对象实例的检查。Null对象不是检查空值，而是反应一个不做任何动作的关系。这样的 Null 对象也可以在数据不可用的时候提供默认的行为。在空对象模式中，我们创建一个指定各种要执行的操作的抽象类和扩展该类的实体类，还创建一个未对该类做任何实现的空对象类，该空对象类将无缝地使用在需要检查空值的地方。
 ****************************************************************/
namespace Lib\ObjectDesign;

class  NullObjectPatternDemo
{


}



/**
 * 
 */
abstract class AbstractCustomer 
{
	protected  $name;
   	public abstract  isNil();
   	public abstract  getName();
	
}

/**
 * 
 */
class RealCustomer extends AbstractCustomer
{
	
	function __construct($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function isNil()
	{
		return false;
	}



}

class NullCustomer extends AbstractCustomer {
 
   public function getName() {
      return "Not Available in Customer Database";
   }
 
   
   public function isNil() {
      return true;
   }
}

/**
 * 
 */
class CustomerFactory  
{
	public static final $names = ['dala','xiao','gulao'];

	public static function getCustomer($name)
	{
		if(in_array($name, static::$names)){
			return new RealCustomer($name);
		}

		return new NullCustomer();
	}

}

























