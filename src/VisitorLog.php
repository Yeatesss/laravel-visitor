<?php
namespace Yeates\Visitor;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Yeates\Visitor\Models\VisitorLogger;
use Yeates\Visitor\Models\VisitorRequest;
use Yeates\Visitor\Services\IpHandleService;

class VisitorLog{
    
    protected $ipHandleService;
    
    public function __construct(IpHandleService $ipHandleService)
    {
        $this->ipHandleService = $ipHandleService;
    }

    public function getRequestData(){
        return ['method'=>request()->getMethod(),'url'=>request()->path(),'data'=>request()->input()];
    }

    public function requestLog($guard_name='',$ip='',$requestData,$description=''){
        $visitorLog['description'] = $description;

        $requestData['request_method'] = $requestData['method'];
        $requestData['request_url'] = $requestData['url'];
        $requestData['request_data'] = json_encode($requestData['data']);
        $visitorRequest = VisitorRequest::create($requestData);
        $visitorLog['visitor_request_id']=$visitorRequest->id;
        if(empty($ip)){
            Request::setTrustedProxies(['127.0.0.1']);
            $ip = Request::getClientIp();
        }
        $ipDetails = $this->ipHandleService->handle($ip);
        if(!empty($ipDetails->ip)){
            $visitorLog['visitor_ip_id'] = IpHandleService::save($ipDetails);
        }else{
            $visitorLog['visitor_ip_id'] = 0;
        }

        try{
            $visitorLog['auth_user_id'] = Auth::guard($guard_name)->id();
            $visitorLog['guard_name'] = $guard_name;
        }catch (\Exception $e){
            $visitorLog['auth_user_id'] = 0;
            $visitorLog['guard_name'] = '';
        }

        $visitorLogger = VisitorLogger::create($visitorLog);

        return $visitorLogger;

    }
    public function geoIp(string $ip){
        $ipDetails = $this->ipHandleService->handle($ip);
        return $ipDetails;
    }
}