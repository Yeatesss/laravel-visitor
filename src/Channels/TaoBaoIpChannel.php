<?php
namespace Yeates\Visitor\Channels;



use Ixudra\Curl\Facades\Curl;
use Yeates\Visitor\Services\IpHandleService;

class TaoBaoIpChannel extends IpChannel {
    
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
        return $this->detailHandle($detail->content->data);
    }
    
    private function detailHandle($data){
        $field_trans = ['ip'=>'ip','country'=>'country','region'=>'region','city'=>'city','isp'=>'isp'];
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