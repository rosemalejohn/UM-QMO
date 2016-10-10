<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ["name"]; 

    protected $dates = ['deleted_at'];


    public function files()
    {
        return $this->hasMany(File::class);
    }
}
