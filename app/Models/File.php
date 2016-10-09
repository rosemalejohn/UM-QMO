<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \App\User;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = ["user_id","url","filename","description","mimetype","size","category_id","department_id"];

    protected $dates = ['deleted_at']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
