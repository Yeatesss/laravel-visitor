<?php
namespace Yeates\Visitor\Channels;

use itbdw\Ip\IpLocation;

class CzIpChannel extends IpChannel {
    
    protected $channel;
    public function __construct()
    {
        $this->channel = $this->getChannelName(__CLASS__);
    }
    
    public function get($ip){
        $channelUrl = $this->getChannelUrl($ip,$this->channel);
        $path = pathinfo(__FILE__)['dirname'].'/'.$channelUrl;
        if(file_exists($path)){
            $ipData = IpLocation::getLocation($ip, $path);
            if(!isset($ipData['error'])){
                return $this->detailHandle($ipData);
            }
        }
        return false;
        
    }
    
    private function detailHandle($data){
        $field_trans = ['ip'=>'ip','country'=>'country','province'=>'region','city'=>'city','isp'=>'isp'];
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