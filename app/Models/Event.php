<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ["user_id", "title", "body", "from", "to", "type"];
}
