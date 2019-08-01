<?php
namespace Lib;

trait CommonTrait
{
	public function publics()
	{
		$reflect = new \ReflectionClass(__CLASS__);

		$props   = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
		$result = [];
		foreach ($props as $value) {
			$result[$value->getName()] = $value->getValue($this);
		}
		return $result;
	}
}