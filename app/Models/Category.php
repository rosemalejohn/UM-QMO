<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ["name", "description"];

    protected $dates = ['deleted_at'];

    public function files()
    {
        return $this->belongsToMany(File::class, 'category_files');
    }
}
