<?php
namespace Lib;

function load($class_name)
{
	$part = explode('\\', $class_name);
	if($part[0]=='Lib'){
		$file = str_replace('Lib\\', '', $class_name);
		$file = __DIR__.'/'.str_replace('\\', '/', $file).'.php';
		if(file_exists($file)){
			include $file;
		}
	}

}

spl_autoload_register('Lib\load', true, true);