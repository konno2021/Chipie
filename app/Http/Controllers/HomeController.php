<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Inn;
use \App\user;
use \App\plan;


class HomeController extends Controller
{
    public function top(){
        return view('home/top');
    }

    public function mypage()
    {
        $reservations = \Auth::user()->reservations()->with('plan.inn')->orderBy('created_at', 'desc')->get();
        return view('home/mypage',['reservations'=> $reservations]);
    }

    public function admin_top()
    {
        $users=User::where('inn_id', null)->where('is_admin', null)->orderBy('created_at','desc')->take(5)->get();
        $inns=Inn::where('is_ok', true)->orderBy('created_at', 'desc')->take(5)->get();
        $plans=Plan::with('inn')->orderBy('created_at','desc')->take(5)->get();
        $inn_requests=Inn::where('is_ok', false)->orderBy('created_at','desc')->take(5)->get();
        return view('home.admin', ['users'=>$users, 'inns'=>$inns, 'plans'=>$plans, 'inn_requests'=>$inn_requests]);

    }
}
