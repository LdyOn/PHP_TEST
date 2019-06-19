<?php

/***********************************************************
 适配器模式（Adapter Pattern）是作为两个不兼容的接口之间的桥梁。这种类型
 的设计模式属于结构型模式，它结合了两个独立接口的功能。
这种模式涉及到一个单一的类，该类负责加入独立的或不兼容的接口功能。举个真实
的例子，读卡器是作为内存卡和笔记本之间的适配器。您将内存卡插入读卡器，再将
读卡器插入笔记本，这样就可以通过笔记本来读取内存卡。
应用实例： 1、美国电器 110V，中国 220V，就要有一个适配器将 110V 转化为 
220V。 2、JAVA JDK 1.1 提供了 Enumeration 接口，而在 1.2 中提供了 
Iterator 接口，想要使用 1.2 的 JDK，则要将以前系统的 Enumeration 
接口转化为 Iterator 接口，这时就需要适配器模式。 3、在 LINUX 上运行
WINDOWS 程序。 4、JAVA 中的 jdbc。 
***********************************************************/
namespace Lib\ObjectDesign;

class AdapterPattenDemo 
{
	
	function __construct()
	{
		
	}

	public function playMedia($type,$file)
	{
		$player = new Player;
		$player->play($type,$file);
	}

		

}

//原先的一个播放器接口，可以播放MP3文件，现在通过适配模式扩充该接口
interface MediaPlayer{
	public function play($type,$file);
}

//高级播放器接口，可以播放MP4和avi文件
interface AdvancedMeidaPlayer{
	public function playMp4($file);
	public function playAvi($file);

}


/**
 * 当前播放器只能播放MP3格式的文件，为了兼容播放MP4和avi格式，定义一个适配器类，通过适配器来播放MP4和AVI格式的文件
 */
class  Player implements MediaPlayer
{
	
	public function play($type,$file)
	{
		if('mp3'==$type){
			print('播放MP3');
		}elseif('mp4'==$type || 'avi'==$type){
			$adpter = new MediaAdapter;
			$adpter->play($file);
		}else{
			throw new Exception("Wrong file type", 1);
			
		}
	}

	
}

/**
 * mp4播放器类
 */
class Mp4Player implements AdvancedMeidaPlayer
{
	
	function __construct()
	{
		
	}

	public function playMp4($file){

	}
	public function playAvi($file){

	}
}
/*
*
*avi播放器类
*/

class AviPlayer implements AdvancedMeidaPlayer
{
	
	function __construct()
	{
		
	}

	public function playMp4($file){

	}

	public function playAvi($file){

	}
}

/**
 * 实现了播放器接口的适配器类
 */
class MediaAdapter implements MediaPlayer
{
	protected $advanced_media_play;

	function __construct($media_type)
	{
		if($media_type=='mp4'){
			$this->advanced_media_play = new Mp4Player;
		}elseif($media_type=='avi'){
			$this->advanced_media_play = new AviPlayer;
		}else{
			throw new Exception("Wrong media type", 1);
			
		}
	}

	public function play($media_type,$file)
	{
		if($media_type=='mp4'){
			$this->advanced_media_play->playMp4($file);
		}elseif($media_type=='avi'){
			$this->advanced_media_play->playAvi($file);
		}else{
			throw new Exception("Wrong media type", 1);
		}
	}
		
}




	