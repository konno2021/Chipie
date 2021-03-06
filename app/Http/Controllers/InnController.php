<?php

namespace App\Http\Controllers;

use DateTime;
use App\User;
use App\Inn;
use App\Plan;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\assertFalse;

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
                $check_in = new DateTime($request->check_in);
                // $check_in = date('Y-m-d h:', strtotime($request->check_in));
                $query_p->where('started_at', '<=', "{$check_in->format('Y-m-d')}");
            }
            // チェックアウト日付検索
            if($request->check_out){
                $check_out = new DateTime($request->check_out);
                // $check_out = date('Y-m-d', strtotime($request->check_out));
                $query_p->where('ended_at', '>=', "{$check_out->format('Y-m-d')}");
            }
            // チェックイン、チェックアウトが反転している場合
            if($request->check_in && $request->check_out){
                $check_in = new DateTime($request->check_in);
                $check_out = new DateTime($request->check_out);
                if($check_in >= $check_out){
                    $query_p->where('id', -1);
                }
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
            
            // 宿の評価、プランの評価
            $inn_values = array();
            $plan_values = array();
            foreach($inns as $inn){
                $num_count = 0;
                $value_count = 0;
                foreach($inn->plans as $plan){
                    $plan_values[$plan->id] = $plan->posts->average('value');
                    if(!is_null($plan_values[$plan->id])){
                        $num_count += $plan->posts->count();
                        $value_count += $plan->posts->sum('value');
                    }
                    else{
                        $plan_values[$plan->id] = -1;
                    }
                }
                if($num_count !== 0){
                    $inn_values[$inn->id] = $value_count / $num_count;
                }
                else{
                    $inn_values[$inn->id] = -1;
                }
            }

            return view('inn/inn_index', ['inns' => $inns, 'plans' => $plans, 'inn_values' => $inn_values, 'plan_values' => $plan_values]);
        }
        return back();
        // elseif($user_status === 3)  {
        //     $inn_lists=Inn::with('inn_code')->where('is_ok', true)->paginate(20);
        //     return view(route('admin/inn_list'));
        // }
    }

    public function index_request_list() //宿アカウント登録申請の一覧
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            $inn_request_lists=Inn::with('inn_code')->where('is_ok', false)->paginate(20);
            return view('inn/inn_request_list', ['inn_request_lists'=>$inn_request_lists]);
        }
        return back();
    }

    public function index_list() //宿アカウントの一覧
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            $inn_lists=Inn::with('inn_code')->where('is_ok', true)->paginate(20);
            return view('inn/inn_list', ['inn_lists'=>$inn_lists]);
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
        $this->validate($request, [
            'name'  => 'required|max:255',
            'address' => 'required|unique:inns|max:255',
            'tel' => 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/|min:10|max:14|required',
            'email' => 'required|email|unique:inns|max:255',
            'check_in' => 'required',
            'check_out' => 'required',
            // 'hp' => 'url',//これがあるとURLが必須になってしまう
            'password' => 'required|between:8,20',
        ]);
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
        $user_status = Controller::get_user_status();
        if($user_status === 0 || $user_status === 1){
            $plans = Plan::where('inn_id', $inn->id)->with(['posts' => function ($query){
                $query->orderBy('created_at', 'desc');
            }])->get();
            return view('inn/inn_show', ['inn' => $inn, 'plans' => $plans]);
        }
        return back();
    }

    public function show_list($id)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 2) {           
            $inn = Inn::with('inn_code')->find($id);
            if(\Auth::user()->can('view', $inn)) {
                return view('inn.inn_show_list', ['inn' => $inn]);
            }
            abort(403,'This action is unauthorized.');

        }
        elseif($user_status === 3){
            $inn = Inn::with('inn_code')->find($id);
            return view('inn.inn_show_list', ['inn' => $inn]);
        }
        return back();
    }

    public function show_request_list($id)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            $inn = Inn::with('inn_code')->find($id);
            return view('inn.inn_request_show', ['inn' => $inn]);
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inn  $inn
     * @return \Illuminate\Http\Response
     */
    public function edit(Inn $inn)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 2) {
            $this->authorize($inn);
            return view('inn.inn_edit', ['inn' => $inn]);
        }
        elseif($user_status === 3){
            return view('inn.inn_edit', ['inn' => $inn]);
        }
        return back();
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
        $user = User::where('inn_id', $inn->id)->first();
        $this->validate($request, [
            'name'  => 'required|max:255',
            'address' => ['required', 'max:255', Rule::unique('inns')->ignore($inn->id), Rule::unique('users')->ignore($user->id)],
            'tel' => 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/|min:10|max:14|required',
            'email' => ['required', 'email', Rule::unique('inns')->ignore($inn->id), Rule::unique('users')->ignore($user->id)],
            'check_in' => 'required',
            'check_out' => 'required',
            'password' => ['required', 'string', 'min:8'],
        ]);
        $password = Hash::make($request->password);
        $password = array('password' => $password);
        $request->merge($password);
        $inn->update($request->all());
        $user->update($request->all());
        $user_status = Controller::get_user_status();
        if($user_status === 3){
        return redirect(route('inn.list'));

        }elseif($user_status === 2){
        return redirect('inn_admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inn  $inn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inn $inn)
    {
        if($inn->is_ok === 0) {
            $inn = Inn::find($inn->id);
            $inn->delete();
            return redirect(route('admin_top'));
            }
        elseif($inn->is_ok === 1) {
            $user = User::where('inn_id', $inn->id)->first();
            $user->deleted_at=date("Y-m-d H:i:s");
            $user->save();
            $inn->delete();
            return redirect(route('inn.list'));
        }
    }
}
