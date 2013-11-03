<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metrika {
    
    public function __construct()
    {
        $this->token = '0172993a772f43989c7541e3b679b4d5';
        $this->id    = 22455862;
    }
    
    public function getSummary()
    {
        $resp = file_get_contents('http://api-metrika.yandex.ru/stat/traffic/summary.json?id='.$this->id.'&pretty=1&oauth_token='.$this->token);
        return json_decode($resp);
    }
}