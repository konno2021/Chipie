<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;

use App\User;
use App\Inn;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            $user_lists = User::where('is_admin', false)->where('inn_id', null)->where('deleted_at', null)->paginate(20);
            return view('user/user_list', ['user_lists'=>$user_lists]);
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_status=Controller::get_user_status();
        if($user_status===3){
            $inn=Inn::find($request->inn_id);
            $inn->is_ok=true;
            // $inn->password=Hash::make('123456789');//宿アカウントのパスワードがなかった時に使用していた
            $inn->save();
            $user=new User;
            $user->name=$request->name;
            $user->address=$request->address;
            $user->tel=$request->tel;
            $user->email=$request->email;
            $user->password=$request->password;
            $user->inn_id=$request->inn_id;
            $user->birthday=null;
            $user->is_admin=false;
            $user->deleted_at=null;
            $user->save();
            return redirect(route('admin_top'));
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user_status = Controller::get_user_status();
        if($user_status){
            return view('user.show', ['user'=>$user]);
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 1 || $user_status === 3){
            return view('user.user_edit', ['user' => $user]);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'  => 'required|max:255',
            'address' => 'required|max:255', 
            'tel' => 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/|min:10|max:14|required',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'birthday' => 'required|before:today',
            'password' => ['required', 'string', 'min:8'],
        ]);
        $password = Hash::make($request->password);
        $password = array('password' => $password);
        $request->merge($password);
        $user->update($request->all());

        $user_status = Controller::get_user_status();
        if($user_status === 1){
            return redirect(route('mypage'));
        }
        else if($user_status === 3){
            return redirect(route('users.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user=User::find($user->id);
        $user->deleted_at=date("Y-m-d H:i:s");
        $user->save();
        return redirect(route('users.index'));
    }

    public function destroy_request(Inn $inn_request_list)
    {   
        $inn_request=Inn::find($inn_request_list->id);
        $inn_request->delete();
        return redirect('/');
    }
}
