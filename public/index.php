<?php 
//********************加载类库***********************
require_once '../common/functions.php';
require_once '../lib/autoloader.php';
require_once '../vendor/autoload.php';
//***************************************************
// echo sys_get_temp_dir();die;
$zip = new ZipArchive;
$zip->open('扫码付.zip',ZIPARCHIVE::CREATE);
$zip->addFile('./images/aa.jpg','helo.jpg');
$zip->addFile('./images/bb.jpg','wo.jpg');
$zip->setCompressionIndex(0, ZipArchive::CM_DEFAULT);
$zip->setCompressionIndex(1, ZipArchive::CM_DEFAULT);
$zip->close();

$fp = fopen('扫码付.zip', 'rb');
$file_size = filesize('扫码付.zip');

$file_name = '扫码付.zip';
//返回的文件
header("Content-type:application/octet-stream");
//按照字节返回
header("Accept-Ranges:bytes");
//返回这个文件大小
header("Accept-Length:$file_size");
//对应客户端弹出的对话框，对应的文件名
header("Content-Disposition:attachment;filename=".$file_name);


$buffer = 1024;
$file_count = 0;

//用于判断数据读取
while(!feof($fp) && $file_size-$file_count>0){
    $file_count+=$buffer;
    $file_data = fread($fp,$buffer);
    //把部分数据回送给浏览器
    //echo $file_count;//输出文件的时候不能有其他的echo 否则实际下载的写入的图片大小会和实际图片大小有出入
    echo $file_data;

}
fclose($fp);
unlink('扫码付.zip');
















