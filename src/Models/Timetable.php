<?php

namespace Farbesofts\Checkrole\Models;

use Config;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    public function user()
    {
        return $this->belongsTo(config('auth.model') ?: config('auth.providers.users.model'))->withTimestamps();
    }
}
