<?php


function load($class_name)
{
	$part = explode('\\', $class_name);
	if($part[0]=='Lib'){
		if(file_exists($file='./'.join('\\',[ $part[1],$part[2]])))
			include $file;
	}

}

spl_autoload_register('load',true,true);