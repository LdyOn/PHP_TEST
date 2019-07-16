<?php
//在浏览器打印用户友好的变量信息
function  dd(...$value){
var_dump();die;	
	foreach ($value as $v) {
		$type = gettype($v);
		switch ($type) {
			case 'integer':
				echo '<div style="color:black;margin-bottom:10px;">'.integerValue($v).'</div>';
				break;
			case 'string':
				echo '<div style="color:black;margin-bottom:10px;">'.stringValue($v).'</div>';
				break;
			case 'array':
				echo arrayValue($v);
				break;
			default:
				# code...
				break;
		}
	}
	

	die;
};

function arrayValue($value)
{
	$margin_left = 0;
	$str = '<div style="padding-left:10px;color:black;margin-bottom:10px;">Array['.count($value).']<br>{<br>';
	foreach ($value as $k => $v) {
		switch (gettype($v)) {
			case 'integer':
				$str .= '<div style="margin-left:20px;">['.$k.'] => (integer)'.$v.'</div>';
				break;
			case 'string':
				$str .= '<div style="margin-left:20px;">['.$k.'] => (string)  "'.$v.'"</div>';
				break;
			case 'array':
				$str .= '<div style="margin-left:20px;"><div style="float:left;">['.$k.'] =></div><div style="float:left;">'.arrayValue($v).'</div><div style="clear:both"></div></div>';
				break;
			default:
				# code...
				break;
		}	
	}

	$str .= '}</div>';

	return $str;
}

function stringValue($value)
{
	return '<div>(string) "'.$value.'"</div>';
}

function integerValue($value)
{
	return '<div>(integer)'.$value.'</div>';
}


