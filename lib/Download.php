<?php
namespace Lib;

/**
 * 
 */
class Download 
{
	
	function __construct()
	{
		
	}

	/*
	*下载文件
	*
	*/
	public function download($path, $filename, $content_type='')
	{
		$fp = fopen($path, 'rb');
		$file_size = filesize($fp);
		//返回的文件
		header("Content-type:application/octet-stream");
		//按照字节返回
		header("Accept-Ranges:bytes");
		//返回这个文件大小
		header("Accept-Length:$file_size");
		//对应客户端弹出的对话框，对应的文件名
		header("Content-Disposition:attachment;filename=".$filename);
		$buffer = 1024;
		$file_count = 0;

		//用于判断数据读取
		while(!feof($fp) && $file_size-$file_count>0){
		    $file_count+=$buffer;
		    $file_data = fread($fp,$buffer);
		    
		    echo $file_data;

		}

		fclose($fp);
	}





}




