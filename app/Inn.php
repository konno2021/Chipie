<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inn extends Model
{
    protected $fillable=['inn_code_id','name', 'address', 'tel', 'email', 'check_in', 'check_out', 'hp' ] ;

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
        return $this->belongsTo(InnCode::class);
    }

}
