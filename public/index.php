<?php 
//********************加载类库***********************
require_once '../common/functions.php';
require_once '../lib/autoloader.php';
require_once '../vendor/autoload.php';
//***************************************************



interface TranslatorInterface
{
    public function translateOne(string $word): string;

    public function translateMany(array $words): array;
}

/**
 * 
 */
class BaiDuTranslator implements TranslatorInterface
{
    protected $app_id;
    public $from;
    public $to;
    protected $app_key;

    private $url = 'http://api.fanyi.baidu.com/api/trans/vip/translate';
    
    function __construct($config)
    {
        $this->app_id = $config['app_id'];
        $this->from = isset($config['from'])?$config['from']:'auto';
        $this->to = isset($config['from'])?$config['to']:'zh';
        $this->app_key = $config['app_key'];
    }

    protected function genSalt(){
        return rand(1000,9999).rand(1000,9999);
    }

    public function translateOne(string $word): string
    {
        $salt = $this->genSalt();
        $sign = $this->genSign($word,$salt);
        $data = [
            'q'=>urlencode($word),
            'from'=>$this->from,
            'to'=>$this->to,
            'app_id'=>$this->app_id,
            'salt'=>$salt,
            'sign' => $sign,
        ];
        $query_params = $this->queryParams($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_URL, $this->url.'?'.$query_params);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);

        $out_put = curl_exec($ch);
        curl_close($ch);

        $result =  json_decode($out_put,true);

        return $result['trans_result'];


    }

    public function translateMany(array $words): array
    {
        //太累了不寫了
    }

    public function  setFrom($from){
        $this->from = $from;
    }

    public function  setTo($to){
        $this->to = $to;
    }

    protected function queryParams($data){
        $str = '';
        foreach ($data as $key => $value) {
            $str .= $key.'='.$value.'&';
        }
        return substr($str, 0, -1);
    }


    protected function genSign($query,$salt){

        return strtolower(md5($this->app_id.$query.$salt.$this->app_key));
    }





}














