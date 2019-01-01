<?php
namespace Yeates\Visitor\Models;
use Illuminate\Database\Eloquent\Model;
class VisitorRequest extends Model{
    protected $fillable = ['request_method','request_url','request_data'];
}