<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memo extends Model
{
    use SoftDeletes;

    protected $fillable = ["user_id", "title", "body"];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTwoDaysOld($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays(2));
    }
}
