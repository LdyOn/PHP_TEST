<?php

$ch = curl_init("http://www.baidu.com/");
$fp = fopen("ehello.txt", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);