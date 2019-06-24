<?php

require_once '../lib/autoloader.php';

use Lib\Macroable;
use Lib\ObjectDesign\Sington;
/**
 * 
 */
class A 
{
    use Macroable;

    protected $city = '北京';
    
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

    public static function hello($value='')
    {
        
    }
}


$clo = function($city){
    $this->setCity($city);
};

$a = new A;


class Solution {

    /**
     * @param String $s1
     * @param String $s2
     * @param String $s3
     * @return Boolean
     */
    function isInterleave($s1, $s2, $s3) {
        $i=$j=$k=0;//初始话s1,s2,s3下标
        $len1 = strlen($s1);
        $len2 = strlen($s2);
        $len3  =  strlen($s3);
        if($len1+$len2 != $len3)
            return false;
        //遍历字符串s3
        while ($k<$len3) {
            $s1_slide = 0;//s1和s3匹配，比较滑动位数
           
            while($i + $s1_slide<$len1 &&$s1[$i + $s1_slide]==$s3[$k + $s1_slide])
                $s1_slide++;
            
            $s2_slide = 0;
            while($j + $s2_slide<$len2 && $s2[$j + $s2_slide]==$s3[$k + $s2_slide])
                $s2_slide++;

            //取“滑动”最远，即片段最长的子串
            if($s1_slide==0&&$s2_slide==0)
                return false;

            if($s1_slide>$s2_slide){
                $i+=$s1_slide;
                $k+=$s1_slide;
            }else{
                $j+=$s2_slide;
                $k+=$s2_slide;
            }


        }

        return true;   
            
    }
}

$demo = new Lib\ObjectDesign\FlyweightPatternDemo();
$demo->test();





















