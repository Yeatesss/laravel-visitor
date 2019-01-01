<?php
namespace Yeates\Visitor\Models;
use Illuminate\Database\Eloquent\Model;
class VisitorLogger extends Model{
    protected $fillable = ['guard_name','auth_user_id','visitor_ip_id','visitor_request_id','description'];


    public function ipPool(){
        return $this->hasOne(VisitorIpPool::class,'id','visitor_ip_id');
    }

    public function request(){
        return $this->hasOne(VisitorRequest::class,'id','visitor_request_id');
    }
}