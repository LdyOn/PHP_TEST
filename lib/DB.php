<?php
namespace Lib;

require  'DbInterface.php';
/**
* 
*/
class DB  implements  DbInterface
{
	private $db;
	protected  $table;
	protected  $data = array();
	protected  $where;

	function __construct($config=[])
	{
		try{
			$dsn = "mysql:host={$config['host']};dbname={$config['db_name']}"; 
			$this->db = new \PDO($dsn,$config['user_name'], $config['password']);
		}catch(\PDOException $e){
			print "Error: " . $e->getMessage() . "<br/>";
    		die();
		}

	}
	/*
	获取数据
	@param array|string  $field 字段值
	@return 
	*/
	public  function  get($field = [])
	{
		
		if( empty($field) ){
			$sql = "SELECT * FROM {$this->table} ";
		}elseif(is_array($field)){
			$fields = implode(',', $field);
			$sql = "SELECT {$fields} FROM {$this->table} ";
		}elseif(is_string($field)){
			$sql = "SELECT {$field} FROM {$this->table}  ";
		}else{
			
			try{
				throw new \Exception("get()方法参数错误", 1);	
			}catch(\Exception $e){
				echo 'Message: ' .$e->getMessage()." in  ".$e->getFile()." in  line".$e->getLine();
				//var_dump($e->getTrace());
				exit();
			}

		}			
		
		if(!empty($this->where))
			$sql .= 'WHERE '.$this->where;
		//echo $sql;die();
		return $this->query($sql);
	}
	/*
	更新数据
	@param array  $data 要跟新的字段
	@return  $this
	*/
	public  function  update($data)
	{//var_dump($data);die();
		if(is_array($data)){
			$sql = "UPDATE  {$this->table}  SET $data[0] = '$data[1]' ";
			if(!empty($this->where))
				$sql .= 'WHERE '.$this->where;
			return $this->query($sql);
		}else{
			throw new Exception("paramter data should be an array", 1);			
		}
		return $this;
	}
	/*
	添加查询条件
	@param array  $where 限定条件
	@return  $this
	*/
	public  function  where($where)
	{
		if(is_array($where)){
			$this->where =  "$where[0]  $where[1]  '$where[2]'";
		}else{
			throw new Exception("paramter where should be an array", 1);
			
		}
		return $this;
	}

	public  function  delete()
	{

	}
	public  function  limite()
	{

	}
	public  function  orderBy()
	{

	}
	public  function  add()
	{

	}
	public  function  first()
	{

	}
	/*
	@param   string  $table  表名
	@return  object 数据库实例
	*/
	public  function  table($table)
	{	
		$this->table = $table;
		return $this;
	}

	public function  toArray()
	{

	}

	public function __get($name)
	{
		if( array_key_exists($name, $this->data) ){
			return $data[$name];
		}else{
			//throw new \Exception("{$name}不存在", 1);		
		}
	}
	/*
	@param  String  $sql sql语句
	@return obj  数据库实例
	*/
	public function query ($sql)
	{
		$pre = $this->db->prepare($sql); //预处理
		$pre->execute(); //执行查询			
		$result = $pre->fetchAll(\PDO::FETCH_OBJ); //处理结果
		return $result;
		
	}

	


}