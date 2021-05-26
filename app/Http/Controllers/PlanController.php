<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Inn;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_status = Controller::get_user_status();
        if($user_status === 2) {
            $plans = Plan::where('inn_id', \Auth::user()->inn_id)->paginate(10);
            return view('home/inn_admin', ['plans' => $plans]);
        }
        elseif($user_status === 3) {
            $plan_lists=array();
            $plan_lists=plan::with('inn')->get();
            return view('plan.plan_list', ['plan_lists'=>$plan_lists]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_status = Controller::get_user_status();
        if($user_status === 2) {
            return view ('plan/create');
        }
        elseif($user_status === 3) {
            $inn_lists=array();
            $inn_lists=Inn::all();
            return view('plan.create', ['inn_lists'=>$inn_lists]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'inn_id' => 'required',
            'plan_name' => 'required|max:255',
            'price' => 'required|min:0',
            'description' => 'required|max:255',
            'room' => 'required',
            'started_at' => 'required',
            'ended_at' => 'required',
        ]);
        $plan = new \App\Plan;
        $plan->create($request->all());
        return redirect('/inn_admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        $plan=plan::with('inn')->first();
        return view('plan.plan_show', ['plan'=>$plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('plan.plan_edit', ['plan'=>$plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $this->validate($request, [
            'inn_id' => 'required',
            'plan_name' => 'required|max:255',
            'price' => 'required|min:0',
            'description' => 'required|max:255',
            'room' => 'required',
            'started_at' => 'required',
            'ended_at' => 'required',
        ]);
        $user_status = Controller::get_user_status();
        $plan->update($request->all());
        if($user_status === 2) {
          return redirect(route('inn_admin_top'));
        }
        elseif($user_status === 3) {
          return redirect('/admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $user_status = Controller::get_user_status();
        $plan->delete();
        if($user_status === 2) {
            return redirect(route('inn_admin_top'));
        }
        elseif ($user_status === 3) {
            return redirect(route('admin_top'));
        }
    }
}
