<?php

namespace App\Http\Controllers;

use DateTime;
use App\Plan;
use App\Inn;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;

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
            $plan_lists = Plan::where('inn_id', \Auth::user()->inn_id)->paginate(10);
            return view('plan.plan_list', ['plan_lists' => $plan_lists]);
        }
        elseif($user_status === 3) {
            $plan_lists=array();
            $plan_lists=plan::with('inn')->paginate(20);
            return view('plan.plan_list', ['plan_lists'=>$plan_lists]);
        }
        return back();
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
        return back();
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
            'price' => 'required|gt:0',
            'description' => 'required|max:255',
            'room' => 'required|gt:0',
            'started_at' => 'required|after:today',
            'ended_at' => 'required|after:started_at',
        ]);

        // 自作バリデーション用変数
        $errors = new ViewErrorBag;
        $messages = new MessageBag;

        $started_at = new DateTime($request->started_at);
        $ended_at = new DateTime($request->ended_at);

        // チェックイン、チェックアウト反転バリデーション
        if($started_at > $ended_at){
            $messages->add('', 'プランの終了年月日は開始年月日より後の日付を選択してください。');
            $errors->put('default', $messages);
            $request->session()->flash('errors', $errors);
            // oldのデータを残すため
            return back()->withInput();
        }

        $plan = new \App\Plan;
        $plan->create($request->all());

        $user_status = Controller::get_user_status();
        if($user_status === 2){
            return redirect(route('inn_admin_top'));
        }
        else if($user_status === 3){
            return redirect(route('admin_top'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 2){
            $this->authorize($plan);
            return view('plan.plan_show', ['plan'=>$plan]);
        }elseif($user_status === 3){
            return view('plan.plan_show', ['plan'=>$plan]);
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 2){
            $this->authorize($plan);
            $inn_lists=Inn::where('id', $plan->inn_id)->get();
            return view('plan.plan_edit', ['plan' => $plan, 'inn_lists' => $inn_lists]);
        }elseif($user_status === 3){
            $inn_lists=Inn::where('id', $plan->inn_id)->get();
            return view('plan.plan_edit', ['plan' => $plan, 'inn_lists' => $inn_lists]);
        }
        return back();
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
            'price' => 'required|gt:0',
            'description' => 'required|max:255',
            'room' => 'required|gt:0',
            'started_at' => 'required',
            'ended_at' => 'required',
        ]);

        $plan->update($request->all());

        $user_status = Controller::get_user_status();
        if($user_status === 2) {
          return redirect(route('inn_admin_top'));
        }
        elseif($user_status === 3) {
          return redirect(route('admin_top'));
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
        $plan->delete();
        $user_status = Controller::get_user_status();
        if($user_status === 2) {
            return redirect(route('inn_admin_top'));
        }
        elseif ($user_status === 3) {
            return redirect(route('admin_top'));
        }
    }
}
