<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inn extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function inn_code()
    {
        return $this->belongsTo(inn_code::class);
    }
}
