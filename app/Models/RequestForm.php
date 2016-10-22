<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestForm extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['name', 'college', 'school_year', 'email', 'contact_number', 'request_for'];

    protected $casts = ['is_done' => 'boolean'];
}
