<?php

namespace App\Http\Controllers;

use DateTime;
use App\Reservation;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = \Auth::user()->plans()
            ->orderBy('created_at', 'desc')->paginnate(5);
            return view('mypage',['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Plan $plan)
    {
        return view('reservation/reservation_confirm', ['plan' => $plan]);
    }

    public function create_register(Plan $plan, Request $request)
    {
        $this->validate($request, [
            'check_in' => 'required',
            'check_out' => 'required',
            'room' => 'required',
        ]);
        
        // 自作バリデーション用変数
        $errors = new ViewErrorBag;
        $messages = new MessageBag;

        // チェックイン、チェックアウト反転バリデーション
        if((int)$request->sum_price <= 0){
            $messages->add('', 'チェックアウトはチェックインより後の日付を選択してください。');
            $errors->put('default', $messages);
            $request->session()->flash('errors', $errors);
            // oldのデータを残すため
            return back()->withInput();
        }

        // 残り部屋数が存在しないとき
        $query = Reservation::where('plan_id', $plan->id);
        $query->where('check_out', '>=', $request->check_in);
        $query->where('check_in', '<=', $request->check_out);
        $reservations = $query->get();
        $reserved_room = array();
        $begin = new DateTime($request->check_in);
        $end = new DateTime($request->check_out);

        // 自分の分の部屋数を加算
        while($begin <= $end){
            $resreved_room[$begin->format('Y-m-d')] = $request->room;
            $begin->modify('+1 days');
        }
        
        // 他の人が予約している部屋数を加算
        $is_ok = true;
        foreach($reservations as $reservation){
            $begin = new DateTime($request->check_in);
            $end = new DateTime($request->check_out);
            $begin_other = new DateTime($reservation->check_in);
            $end_other = new DateTime($reservation->check_out);
            if($begin < $begin_other){
                $begin = $begin_other;
            }
            if($end > $end_other){
                $end = $end_other;
            }
            $room = $reservation->room;
            while($begin <= $end){
                $resreved_room[$begin->format('Y-m-d')] += $room;
                if($reserved_room[$begin->format('Y-m-d')] > $plan->room){
                    $is_ok = false;
                    break;
                }
                $begin->modify('+1 days');
            }
            if(!$is_ok){
                break;
            }
        }

        // // 部屋数が足りないとき
        // if(!$is_ok){
        //     $messages->add('', '予約できる部屋がありませんでした。チェックイン日、チェックアウト日、部屋数を変更して再度お試しください。');
        //     $errors->put('default', $messages);
        //     $request->session()->flash('errors', $errors);
        //     // oldのデータを残すため
        //     return back()->withInput();
        // }

        $check_in = $request->check_in;
        $check_out = $request->check_out;
        $room = $request->room;
        $demand = $request->demand;
        return view('reservation/create_register', ['plan' => $plan, 'check_in' => $check_in, 'check_out' => $check_out, 'room' => $room, 'is_ok' => $is_ok]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
