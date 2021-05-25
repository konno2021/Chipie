<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
    protected $fillable = ['plan_id', 'user_id', 'room', 'check_in', 'check_out', 'demand', 'token', 'status'];
}
