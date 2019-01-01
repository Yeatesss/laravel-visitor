<?php
namespace Yeates\Visitor\Models;
use Illuminate\Database\Eloquent\Model;
class VisitorRequest extends Model{
    protected $fillable = ['ip','country','region','city','isp','channel'];
}