<?php

function  sayHello()
{
	echo 'hello!';
}

function  generatePassword(){
	$str =  '1234567890qwertyupasdfghjkzxcvbnmQWERTYUPASDFGHJKLZXCVBNM';
	//echo strlen($str);
	$pwd = '';
	for ($i=0; $i <8 ; $i++) { 
		$pwd .= substr($str, rand(0,56), 1);
	}
	return  $pwd;
}

function removeComments($str)
{
	$start = strpos($str, '（');
	if($start !== false)
		$str = substr($str, 0, $start);
	$start = strpos($str, '(');
	if($start !== false)
		$str = substr($str, 0, $start);
	
	return $str; 
}

function  dd($value){
	if(is_array($value)){
		$count = count($value);
		echo "<p>Array[{$count}]:</p>";
		foreach ($value as $k => $v) {
			if(is_array($v)){
				$count = count($v);
				echo "\"{$k}\"=><p>Array[{$count}]:</p>";
				dd($v);
			}
			echo "<p>\"{$k}\"=>{$v}</p>";
		}
	}

	var_dump($value);
	exit();
}

