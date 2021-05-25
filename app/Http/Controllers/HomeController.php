<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
