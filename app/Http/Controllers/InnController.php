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
    public function index(Request $request)
    {
        $user_status = get_user_status();
        if($user_status === 0 || $user_status === 1) {
            // 検索条件によってクエリビルダを作成
            $plans = Plan::with('inn.inn_code');
            
            // 都道府県検索
            if($request->area){
                $area_array = get_area_array();
                $plans->where('address', 'LIKE', "{$area_array[$request->area]}%");
            }
            // 分類コード検索
            if($request->inn_type){
                $plans->where('inn_code_id', $request->inn_type);
            }
            // キーワード検索
            if($request->keyword){
                $plans->where(function ($q){
                    $q->where('name', 'LIKE', "%{$request->keyword}%");
                    $q->orWhere('address', 'LIKE', "%{$request->keyword}%")
                });
            }
            
            // 以下、プランに対する検索
            $inns->plans();

            // 値段の下限検索
            if($request->price_min){
                
            }

            return view(route('inn/inn_index'));
        }
        elseif($user_status === 3)  {
            $inn_lists=Inn::with('inn_code')->paginate(20);
            return view(route('admin/inn_list'));
        }
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
        //
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
