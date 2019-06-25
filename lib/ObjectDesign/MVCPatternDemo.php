<?php

/****************************************************************
MVC 模式代表 Model-View-Controller（模型-视图-控制器） 模式。这种模式用于应用程序的分层开发。
Model（模型） - 模型代表一个存取数据的对象或 JAVA POJO。它也可以带有逻辑，在数据变化时更新控制器。
View（视图） - 视图代表模型包含的数据的可视化。
Controller（控制器） - 控制器作用于模型和视图上。它控制数据流向模型对象，并在数据变化时更新视图。它使视图与模型分离开。

 ****************************************************************/
namespace Lib\ObjectDesign;

class  MVCPatternDemo
{

}

/**
 * 
 */
class Student
{
	private $rollNo;
	private $name;

	function __construct()
	{
		# code...
	}

	public function getRollNo()
	{
		return $this->rollNo
	}


	public function setRollNo($roll_no)
	{
		return $this->rollNo = $roll_no;
	}


	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}


}

/**
 * 
 */
class StudentView 
{
	
	function __construct()
	{
		
	}

	public static function printStudent($name,$roll_no)
	{
		echo $name;
		echo $roll_no;
	}
}

/**
 * 
 */
class StudentController 
{
	private $student_view;
	private $student_model;

	function __construct($student_model, $student_view)
	{
		$this->student_view = $student_view;
		$this->student_model = $student_model;
	}

	public function setStudentName($name){
      	$this->student_model->setName($name);    
	}
 
    public function getStudentName(){
        $this->student_model->getName();    
    }
 
    public function setStudentRollNo($rollNo){
       $this->student_model->setRollNo($rollNo);      
    }
 
    public function getStudentRollNo(){
        return $this->student_model->getRollNo();     
    }
 
	public function updateView(){           
	    echo $this->student_view->printStudent($this->student_model->getName(), $this->student_model->getRollNo());
	}  
}

































