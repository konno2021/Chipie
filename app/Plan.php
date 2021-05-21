<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function inn()
    {
        return $this->belongsTo(Inn::class);
    }
}
