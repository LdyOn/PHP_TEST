<?php

function  getAllFilesFromDir($path)
{
	$handle = opendir($path);
	if(false === $handle)
		return false;
	$f = [];
	while (false !== ($file = readdir($handle))) {
    	if($file ==='.' || $file === '..')
    		continue;
    	if(is_dir($path."\\{$file}"))
    		$f  = array_merge($f,getAllFilesFromDir($path."\\{$file}"));
    	elseif(is_file($path."\\{$file}"))
    		$f[] = $path."\\{$file}";
	}

	return $f;
}

$path = realpath('../files');
 //echo $path;die;
$files = getAllFilesFromDir($path);
// foreach ($files as $file) {
	
// }
foreach ($files as $file) {
	$name = basename($file);
	$content = file_get_contents($file);
	file_put_contents('./code.docx', $name.PHP_EOL, FILE_APPEND);
	file_put_contents('./code.docx', $content.PHP_EOL, FILE_APPEND);
	file_put_contents('./code.docx', PHP_EOL, FILE_APPEND);
	file_put_contents('./code.docx', PHP_EOL, FILE_APPEND);

}

