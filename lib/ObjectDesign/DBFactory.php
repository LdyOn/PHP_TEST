<?php

/***********************************
 * 定义一个工厂类，获取数据库连接
 ***********************************/
namespace Lib\ObjectDesign;

use Lib\Database\Mysql\MysqlConnection;
use Lib\Database\Oracle\OracleConnection;
use Lib\Database\Sqllite\SqlliteConnection;

class  DBFactory 
{
	
	function __construct()
	{
		
	}

	public function getConnection($connecton)
	{
		switch ($connecton) {
			case 'mysql':
				return new MysqlConnection();
				break;
			case 'oracle':
				return new OracleConnection();
				break;
			case 'sqllite':
				return new SqlliteConnection();
				break;
			default:
				throw new Exception("cann't find connecton $connecton", 1);				
				break;
		}
	}
}