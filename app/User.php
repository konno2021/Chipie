<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'inn_id', 'address', 'tel', 'birthday', 'is_admin', 'deleted_at'
    ];

   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function inn(){
        return $this->hasOne(Inn::class);
    }

    public function get_user_status(){
        $user_status = -1;

        if(\Auth::check() === false){
            $user_status = 0;  // 非会員
        }
        else if(\Auth::user()->inn_id !== null){
            $user_status = 2;  // 宿管理者
        }
        else if(\Auth::user()->is_admin){
            $user_status = 3;    // 管理者
        }
        else{
            $user_status = 1;
        }
        return $user_status;
    }

}
