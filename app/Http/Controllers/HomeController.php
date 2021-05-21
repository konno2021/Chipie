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
        $reservations = \Auth::user()->reservations()
            ->orderBy('created_at', 'desc')->paginate(5);
            return view('home/mypage',['reservations'=> $reservations]);
    }
}
