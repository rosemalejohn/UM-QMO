<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ["name", "description","department_id"];

    protected $dates = ['deleted_at'];

    public function files()
    {
        return $this->belongsToMany(File::class, 'category_files');
    }

    public function department()
    {
    	return $this->belongsTo(Department::class,'department_id');
    }
}
