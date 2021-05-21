<?php

namespace App\Http\Controllers;

use App\Inn;
use Illuminate\Http\Request;

class InnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $user_statue = get_user_status();
        if($user_status === 0 || $user_status === 1) {
            $inn_lists=Inn::with('inn_code')->paginate(20);
            return view(route('inn/inn_index'));
        }
        elseif($user_status === 3)  {
            $inn_lists=Inn::with('inn_code')->where('is_ok', true)->paginate(20);
            return view(route('admin/inn_list'));
        }
    }

    public function index_list() 
    {
        $inn_lists=Inn::with('inn_code')->where('is_ok', false)->paginate(20);
        return view(route('admin/inn_request_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inn/inn_request');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inn= new \App\Inn;
        $inn->create($request->all());
        return redirect(route('/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inn  $inn
     * @return \Illuminate\Http\Response
     */
    public function show(Inn $inn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inn  $inn
     * @return \Illuminate\Http\Response
     */
    public function edit(Inn $inn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inn  $inn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inn $inn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inn  $inn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inn $inn)
    {
        //
    }
}
