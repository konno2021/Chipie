<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable=['inn_id','plan_name','price', 'description', 'room', 'ended_at', 'started_at' ] ;

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

    protected $fillable = ['inn_id', 'plan_name', 'price', 'description', 'room', 'started_at', 'ended_at'];
}
