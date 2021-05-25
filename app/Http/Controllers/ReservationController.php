<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Plan;
use Illuminate\Http\Request;

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
            'sum_price' => 'gt:0'
        ]);
        $check_in = $request->check_in;
        $check_out = $request->check_out;
        $room = $request->room;
        $demand = $request->demand;
        return view('reservation/create_register', ['plan' => $plan, 'check_in' => $check_in, 'check_out' => $check_out, 'room' => $room]);
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
        return redirect('/');
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
