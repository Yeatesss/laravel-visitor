<?php
namespace Yeates\Visitor;



use Yeates\Visitor\Services\IpHandleService;

class IpChannel{
    
    public function getChannelName(String $class){
        $classNameExp = explode('\\',$class);
        return end($classNameExp);
    }
    
    public function getChannelUrl($ip,$channelName){
        $channelUrl = IpHandleService::RESOLVE_IP_URL[$this->channel];
        return str_replace('[IP]',$ip,$channelUrl);
    }
}