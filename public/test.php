<?php
ob_end_clean();
header("Connection:close");//告诉浏览器，连接关闭了，这样浏览器就不用等待服务器的响应
ob_start();
header("Content-type:text/html;charset=utf-8");

header("HTTP/1.1 200 OK"); //可以发送200状态码，以这些请求是成功的，要不然可能浏览器会重试，特别是有代理的情况下
echo "running,,,,.<br>";
echo "您的订单已经被处理，因现在是高峰期，请过几分钟中再查看您的订单状态！";
//下面输出http的一些头信息
$size=ob_get_length();
header("Content-Length: $size");
ob_end_flush();#输出当前缓冲
flush();

ignore_user_abort(true);
$i = 10;
while (1) {
	// file_put_contents('hello.txt', "hello world\r\n", FILE_APPEND);
	// $i--;
}
echo '这里的输出用户看不到，后台运行的';

