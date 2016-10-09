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

    protected $appends = ['users_count','files_count'];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    public function getFilesCountAttribute()
    {
        return $this->files()->count();
    }
    

}
