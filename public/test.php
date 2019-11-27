<?php
// 你要跳转的url
$url = "http://www.baidu.com/";
 
// 如果使用的是php-fpm
if(function_exists('fastcgi_finish_request')){
    header("Location: $url");
    ob_flush();
    flush();
    fastcgi_finish_request();
// Apache ?
}else{
    header( 'Content-type: text/html; charset=utf-8' );
    if(function_exists('apache_setenv'))apache_setenv('no-gzip', '1');
    ini_set('zlib.output_compression', 0);
    ini_set('implicit_flush', 1);
    echo "<script>location='$url'</script>";
    ob_flush();
    flush();
}
 
// 这里是模拟你的耗时逻辑
sleep(10);
file_put_contents('aaa.txt', 'okkkkkkk');








