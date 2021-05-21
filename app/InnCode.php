<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InnCode extends Model
{
    public function inns()
    {
        return $this->hasMany(Inn::class);
    }
}
