<?php
namespace Yeates\Visitor\Models;
use Illuminate\Database\Eloquent\Model;
class VisitorIpPool extends Model{
    protected $fillable = ['ip','country','region','city','isp','channel'];
}