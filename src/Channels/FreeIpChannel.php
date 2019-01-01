<?php
namespace Yeates\Visitor\Channels;



use Ixudra\Curl\Facades\Curl;
use Yeates\Visitor\Services\IpHandleService;

class FreeIpChannel extends IpChannel {
    
    protected $channel;
    public function __construct()
    {
        $this->channel = $this->getChannelName(__CLASS__);
    }
    
    public function get($ip){
        $channelUrl = $this->getChannelUrl($ip,$this->channel);
        $detail = Curl::to($channelUrl)->asJson()->returnResponseObject()->get();
        if($detail->status != 200){
            return false;
        }
        return array_merge($this->detailHandle($detail->content),['ip'=>$ip]);
    }
    
    private function detailHandle($data){
        $field_trans = ['0'=>'country','1'=>'region','2'=>'city','4'=>'isp'];
        $res = [];
        foreach($data as $k => $v){
            if(isset($field_trans[$k])){
                $res[$field_trans[$k]]=$v;
            }
        }
        $res['channel']=$this->channel;
        return $res;
    }
}