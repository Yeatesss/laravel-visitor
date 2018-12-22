<?php
namespace Yeates\Visitor;


use Yeates\Visitor\Services\IpHandleService;

class VisitorLog{
    
    protected $ipHandleService;
    
    public function __construct(IpHandleService $ipHandleService)
    {
        $this->ipHandleService = $ipHandleService;
    }
    
    public function geoIp(string $ip){
        $ipDetails = $this->ipHandleService->handle($ip);
        dd($ipDetails);
    }
}