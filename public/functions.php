<?php

function  sayHello()
{
	echo 'hello!';
}

function  generatePassword(){
	$str =  '1234567890qwertyupasdfghjkzxcvbnm';
	// echo substr($str, 32, 1);die;
	$pwd = '';
	for ($i=0; $i <8 ; $i++) { 
		$pwd .= substr($str, rand(0,32), 1);
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



