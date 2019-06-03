<?php
include '../lib/DB.php';
include 'functions.php';


$db_config = require '../config/database.php';
$db = new  \lib\DB($db_config);

$school = (new  \lib\DB($db_config))->table('admin')->get('账号名称');

foreach ($school as $key => $value) {
	
	(new  \lib\DB($db_config))->table('admin')->where(['账号名称','=',$value->账号名称])->update(['密码', generatePassword()]);
}