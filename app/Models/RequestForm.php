<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class RequestForm extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'created_at', 'updated_at','effective_date'];

    protected $fillable = ['request_number','branch','specific_branch','request_nature','document_title','description','reason','request_by','email','document_id','date_issued','rev_number','remarks' ,'is_approved','effective_date','unit_head','is_done'];

    protected $casts = ['is_done' => 'boolean'];

    public function getDateIssuedAttribute($value)
    {
    	return Carbon::parse($value)->toDateString();
    }
    public function getEffectiveDateAttribute($value)
    {
    	return Carbon::parse($value)->toDateString();
    }
}
