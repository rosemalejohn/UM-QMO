<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ["name","code"]; 

    protected $dates = ['deleted_at'];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    

}
