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
        $query->whereNotIn('status', ['3']);
        $reservations = $query->get();
        $reserved_room = array();
        $begin = new DateTime($request->check_in);
        $end = new DateTime($request->check_out);

        // 自分の分の部屋数を加算
        while($begin <= $end){
            $reserved_room[$begin->format('Y-m-d')] = $request->room;
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
                $reserved_room[$begin->format('Y-m-d')] += $room;
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
        $sum_price = $request->sum_price;
        return view('reservation/create_register', ['plan' => $plan, 'check_in' => $check_in, 'check_out' => $check_out, 'room' => $room, 'demand' => $demand, 'sum_price' => $sum_price, 'is_ok' => $is_ok]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservation = new \App\Reservation;
        $reservation->create($request->all());
        return redirect('mypage');
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
    public function update(Request $request, $id)
    {
        // 自分以外の予約済み部屋数を検索、予約状態を更新、他の人の予約状態も更新
        //

        // 自作バリデーション用変数
        $errors = new ViewErrorBag;
        $messages = new MessageBag;

        // チェックイン、チェックアウト反転バリデーション
        $begin = new DateTime($request->check_in);
        $end = new DateTime($request->check_out);
        if($end <= $begin){
            $messages->add('', 'チェックアウトはチェックインより後の日付を選択してください。');
            $errors->put('default', $messages);
            $request->session()->flash('errors', $errors);
            // oldのデータを残すため
            return back()->withInput();
        }

        // 更新するデータでチェック
        $query = Reservation::with('plan');
        $query->where('plan_id', $request->plan_id);
        $query->where('check_out', '>=', $request->check_in);
        $query->where('check_in', '<=', $request->check_out);
        $query->where(function($q){
            $q->where('status', '0');
            $q->orWhere('status', '2');
        });
        $reservations = $query->get();
        $reserved_room = array();

        // 自分の分の部屋数を加算
        while($begin <= $end){
            $reserved_room[$begin->format('Y-m-d')] = (int)$request->room;
            $begin->modify('+1 days');
        }
        // 他の人が予約している部屋数を加算
        $is_ok = true;
        foreach($reservations as $reservation){
            // 既存の自分のデータは考慮しない
            // 左がint、右がstring
            if($reservation->id == $id){
                continue;
            }
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
                $reserved_room[$begin->format('Y-m-d')] += $room;
                if($reserved_room[$begin->format('Y-m-d')] > $reservation->plan->room){
                    $is_ok = false;
                }
                $begin->modify('+1 days');
            }
        }
        // 予約を更新する
        $status = array();
        if($is_ok){
            $status['status'] = '0';
        }
        // キャンセル待ち予約として更新する
        else{
            $status['status'] = '1';
        }
        $request->merge($status);
        $_reservation = Reservation::find($id);
        $_reservation->update($request->all());

        // 予約を更新したことで空き部屋が発生したことによるキャンセル待ち予約の人の処理

        // 予約の人と予約可能の人
        $query = Reservation::where('plan_id', $request->plan_id);
        $query->where('check_out', '>=', date('Y-m-d'));
        $query->where(function($q){
            $q->where('status', '0');
            $q->orWhere('status', '2');
        });
        $reservations_ok = $query->get();

        // キャンセル待ち予約の人
        $query = Reservation::where('plan_id', $request->plan_id);
        $query->where('check_out', '>=', date('Y-m-d'));
        $query->where('status', '1');
        $query->orderBy('updated_at');
        $reservations_wait = $query->get();
        
        // 部屋をカウント
        $reserved_room = array();
        $begin = new DateTime(Reservation::where('plan_id', $request->plan_id)->where('check_out', '>=', date('Y-m-d'))->min('check_in'));
        $end = new DateTime(Reservation::where('plan_id', $request->plan_id)->where('check_out', '>=', date('Y-m-d'))->max('check_out'));
        while($begin <= $end){
            $reserved_room[$begin->format('Y-m-d')] = 0;
            $begin->modify('+1 days');
        }
        foreach($reservations_ok as $reservation){
            $begin = new DateTime($reservation->check_in);
            $end = new DateTime($reservation->check_out);
            $room = $reservation->room;
            while($begin <= $end){
                $reserved_room[$begin->format('Y-m-d')] += $room;
                $begin->modify('+1 days');
            }
        }
        // 部屋の空きをチェック
        foreach($reservations_wait as $reservation){
            if($reservation->id === $id){
                continue;
            }
            $begin = new DateTime($reservation->check_in);
            $_begin = new DateTime($reservation->check_in);
            $end = new DateTime($reservation->check_out);
            $room = $reservation->room;
            $is_ok = true;
            while($begin <= $end){
                if($reserved_room[$begin->format('Y-m-d')] + $reservation->room > $reservation->plan->room){
                    $is_ok = false;
                }
                $begin->modify('+1 days');
            }
            // キャンセル待ち予約中で空き部屋があるなら
            if($reservation->status === '1' && $is_ok){
                $_reservation = Reservation::find($reservation->id);
                $_reservation->status = '2';
                $_reservation->save();
                while($_begin <= $end){
                    $reserved_room[$begin->format('Y-m-d')] += $room;
                    $_begin->modify('+1 days');
                }
            }
        }
        return redirect(route('mypage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // 本来のdestroyとは異なり、statusを'3'にするだけ（キャンセル履歴も残すため）
        $_reservation = Reservation::find($id);
        $_reservation->status = '3';
        $_reservation->save();

        // 予約を更新したことで空き部屋が発生したことによるキャンセル待ち予約の人の処理

        // 予約の人と予約可能の人
        $query = Reservation::where('plan_id', $_reservation->plan_id);
        $query->where('check_out', '>=', date('Y-m-d'));
        $query->where(function($q){
            $q->where('status', '0');
            $q->orWhere('status', '2');
        });
        $reservations_ok = $query->get();

        // キャンセル待ち予約の人
        $query = Reservation::where('plan_id', $_reservation->plan_id);
        $query->where('check_out', '>=', date('Y-m-d'));
        $query->where('status', '1');
        $query->orderBy('updated_at');
        $reservations_wait = $query->get();
        
        // 部屋をカウント
        $reserved_room = array();
        $begin = new DateTime(Reservation::where('plan_id', $_reservation->plan_id)->where('check_out', '>=', date('Y-m-d'))->min('check_in'));
        $end = new DateTime(Reservation::where('plan_id', $_reservation->plan_id)->where('check_out', '>=', date('Y-m-d'))->max('check_out'));
        while($begin <= $end){
            $reserved_room[$begin->format('Y-m-d')] = 0;
            $begin->modify('+1 days');
        }
        foreach($reservations_ok as $reservation){
            $begin = new DateTime($reservation->check_in);
            $end = new DateTime($reservation->check_out);
            $room = $reservation->room;
            while($begin <= $end){
                $reserved_room[$begin->format('Y-m-d')] += $room;
                $begin->modify('+1 days');
            }
        }
        // 部屋の空きをチェック
        foreach($reservations_wait as $reservation){
            if($reservation->id === $id){
                continue;
            }
            $begin = new DateTime($reservation->check_in);
            $_begin = new DateTime($reservation->check_in);
            $end = new DateTime($reservation->check_out);
            $room = $reservation->room;
            $is_ok = true;
            while($begin <= $end){
                if($reserved_room[$begin->format('Y-m-d')] + $reservation->room > $reservation->plan->room){
                    $is_ok = false;
                }
                $begin->modify('+1 days');
            }
            // キャンセル待ち予約中で空き部屋があるなら
            if($reservation->status === '1' && $is_ok){
                $_reservation = Reservation::find($reservation->id);
                $_reservation->status = '2';
                $_reservation->save();
                while($_begin <= $end){
                    $reserved_room[$begin->format('Y-m-d')] += $room;
                    $_begin->modify('+1 days');
                }
            }
        }
        return redirect(route('mypage'));
    }

    public function waiting_to_reserved($id){
        $_reservation = Reservation::find($id);
        $_reservation->status = '0';
        $_reservation->save();
        return redirect(route('mypage'));
    }
}
