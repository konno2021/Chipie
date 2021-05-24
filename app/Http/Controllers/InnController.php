<?php

namespace App\Http\Controllers;

use App\User;
use App\Inn;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 0 || $user_status === 1) {
            // 検索条件によってクエリビルダを作成
            $query_i = Inn::with('inn_code');
            
            // 都道府県検索
            if($request->area){
                $area_array = parent::get_area_array();
                $query_i->where(function ($q) use($area_array, $request){
                    $is_first = true;
                    foreach($request->area as $area){
                        if($is_first){
                            $q->where('address', 'LIKE', "{$area_array[$area]}%");
                            $is_first = false;
                        }
                        else{
                            $q->orWhere('address', 'LIKE', "{$area_array[$area]}%");
                        }
                    }
                });
            }
            // 分類コード検索
            if($request->inn_type){
                if($request->inn_type !== 0){
                    $query_i->where('inn_code_id', $request->inn_type);
                }
            }
            // キーワード検索
            if($request->keyword){
                $query_i->where(function ($q) use ($request){
                    $q->where('name', 'LIKE', "%{$request->keyword}%");
                    $q->orWhere('address', 'LIKE', "%{$request->keyword}%");
                });
            }
            
            // プランに対する検索
            $query_p = Plan::query();
            
            // 最小値検索
            if($request->min_price){
                $query_p->where('price', '>=', "{$request->min_price}");
            }
            // 最大値検索
            if($request->max_price){
                $query_p->where('price', '<=', "{$request->max_price}");
            }
            // チェックイン日付検索
            if($request->check_in){
                $check_in = date('Y-m-d', strtotime($request->check_in));
                $query_p->where('started_at', '<=', "{$check_in}");
            }
            // チェックアウト日付検索
            if($request->check_out){
                $check_out = date('Y-m-d', strtotime($request->check_out));
                $query_p->where('ended_at', '>=', "{$check_out}");
            }
            
            // inn_idをkeyに持つプランの連想配列を作成
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

            // プランの連想配列のkeyを主キーに持たない宿を取り除く
            // プランの検索数が0の宿を表示させないため

            // $query_i->where(function ($q) use($plans){
            //     $is_first = true;
            //     foreach($plans as $inn_id => $plan){
            //         if($is_first){
            //             $q->where('id', '<>', $inn_id);
            //             $is_first = false;
            //         }
            //         else{
            //             $q->where('id', '<>', $inn_id);
            //         }
            //     }
            // });

            // foreach($plans as $inn_id => $plan){
            //     $query_i->where('id', '<>', $inn_id);
            // }

            $query_i->whereIn('id', $ok_id);
            // 宿情報の取得
            $inns = $query_i->paginate(10);
            
            return view('inn/inn_index', ['inns' => $inns, 'plans' => $plans]);
        }
        elseif($user_status === 3)  {
            $inn_lists=Inn::with('inn_code')->where('is_ok', true)->paginate(20);
            return view(route('admin/inn_list'));
        }
    }

    public function index_request_list() //宿アカウント登録申請の一覧
    {
        $inn_request_lists=Inn::with('inn_code')->where('is_ok', false)->paginate(20);
        return view('inn/inn_request_list', ['inn_request_lists'=>$inn_request_lists]);
    }

    public function index_list() //宿アカウントの一覧
    {
        $inn_lists=Inn::with('inn_code')->where('is_ok', true)->paginate(20);
        return view('inn/inn_list', ['inn_lists'=>$inn_lists]);
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
        $password = Hash::make($request->password);
        $password = array('password' => $password);
        $request->merge($password);
        $inn->create($request->all());
        return redirect('/');
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
        return view('inn.inn_edit', ['inn'=>$inn]);
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
        $inn->update($request->all());
        return redirect(route('inn.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inn  $inn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inn $inn)
    {
        $user=User::where('inn_id', $inn->id)->first();
        $user->deleted_at=date("Y-m-d H:i:s");
        $user->save();
        $inn->delete();
        return redirect(route('inn.list'));
    }
}
