<?php


/***********************************************************
 适配器模式（Adapter Pattern）是作为两个不兼容的接口之间的桥梁。这种类型的设计模式属于结构型模式，它结合了两个独立接口的功能。
这种模式涉及到一个单一的类，该类负责加入独立的或不兼容的接口功能。举个真实的例子，读卡器是作为内存卡和笔记本之间的适配器。您将内存卡插入读卡器，再将读卡器插入笔记本，这样就可以通过笔记本来读取内存卡。
 ***********************************************************/
namespace Lib\ObjectDesign;

class AdapterPattenDemo 
{
	
	function __construct()
	{
		
	}

	public function playMedia($file)
	{
		$player = new Player;
		$player->play($file);
	}

	

}

//原先的一个播放器接口，可以播放MP3文件，现在通过适配模式扩充该接口
interface MediaPlayer{
	public function play($file);
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
	
	public function play($file)
	{
		$type = $this->getFileType($file);
		if('mp3'==$type){

		}elseif('mp4'==$type || 'avi'==$type){
			$adpter = new 
		}else{
			throw new Exception("Wrong file type", 1);
			
		}
	}

	public function getFileType($file)
	{
		# code...
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
 * 适配器类
 */
class MediaAdapter 
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




	