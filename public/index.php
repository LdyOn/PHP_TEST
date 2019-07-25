<?php 
//********************加载类库***********************
require_once '../common/functions.php';
require_once '../lib/autoloader.php';
require_once '../vendor/autoload.php';
//***************************************************


$img = \Intervention\Image\Image::make('./images/ff.jpg')->resize(200, null, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
})->insert('./images/ff.jpg', '研学一卡通', 15, 10);
// $img_name = 'ykt'.$image->hashName();
// $path = public_path('images/answer/').$img_name;
$img->save('./images/test.jpg');











