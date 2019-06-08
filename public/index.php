<?php

include "../lib/Macroable.php";

use Lib\Macroable;
/**
 * 
 */
class A 
{
    use Macroable;

    protected $city='北京';
    
    function __construct()
    {
        
    }
    public function sayHello($value='')
    {
        echo 'hello '.$this->city;

    }

    public function setCity($value='')
    {
        $this->city=$value;
    }
}


$clo = function($city){
    $this->setCity($city);
};

$a = new A;
$a->sayHello();
$clo = $clo->bindTo($a,A::class);
$clo('上海');
$a->sayHello();

$a->macro('speak',function($talk){
    echo $talk;
});

$a->speak('what a nice girl!');
echo '🍁';

var_dump($_GET['fjewf']);
// header('location:'.$_GET['fjewf']);
echo "'bane'";

$redis = new \Redis;


















