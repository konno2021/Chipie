<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Inn;
use \App\user;
use \App\plan;


class HomeController extends Controller
{
    public function top(){
        $user_status = Controller::get_user_status();
        if($user_status === 0 || $user_status === 1){
            // inn_idをkeyに持つプランの連想配列を作成
            $query_p = Plan::query();
            $plans = [];
            $ok_id = [];
            foreach($query_p->get() as $plan){
                if(array_key_exists($plan->inn_id, $plans)){
                    array_push($plans[$plan->inn_id], $plan); 
                }
                else{
                    $plans[$plan->inn_id] = array($plan);
                    $ok_id[$plan->inn_id] = $plan->inn_id;
                }
            }
            // ランダムに3件取得
            $inns = Inn::whereIn('id', $ok_id)->inRandomOrder()->take(3)->get();
            return view('home/top', ['inns' => $inns]);
        }
        else if($user_status === 2){
            return redirect(route('inn_admin_top'));
        }
        else if($user_status === 3){
            return redirect(route('admin_top'));
        }
    }

    public function mypage()
    {
        $user_status = Controller::get_user_status();
        if($user_status === 1){
            $reservations = \Auth::user()->reservations()->with('plan.inn')->orderBy('created_at', 'desc')->get();
            return view('home/mypage',['reservations'=> $reservations]);
        }
        return back();
    }

    public function inn_admin_top(){
        $user_status = Controller::get_user_status();
        if($user_status === 2){
            return redirect(route('plans.index'));
        }
        return back();
    }

    public function admin_top()
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            $users=User::where('is_admin', false)->where('inn_id', null)->where('deleted_at', null)->orderBy('created_at','desc')->take(5)->get();
            $inns=Inn::where('is_ok', true)->orderBy('created_at', 'desc')->take(5)->get();
            $plans=Plan::with('inn')->orderBy('created_at','desc')->take(5)->get();
            $inn_requests=Inn::where('is_ok', false)->orderBy('created_at','desc')->take(5)->get();
            return view('home.admin', ['users'=>$users, 'inns'=>$inns, 'plans'=>$plans, 'inn_requests'=>$inn_requests]);
        }
        return back();
    }
}
