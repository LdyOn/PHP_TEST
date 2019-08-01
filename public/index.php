<?php 
//********************加载类库***********************
require_once '../common/functions.php';
require_once '../lib/autoloader.php';
require_once '../vendor/autoload.php';
//***************************************************

// $t = new \Lib\Test;

// dd($t->publics());
preg_match('/^\$\d+(,\d{3})* (\.\d{1,2})?(美元)?$/', '', $matchs);
dd($matchs);












