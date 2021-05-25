<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $user_lists=User::where('is_admin', false)->where('inn_id', null)->where('deleted_at', null)->paginate(20);
        return view('user/user_list', ['user_lists'=>$user_lists]);
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
        if($user_status===1||$user_status===0)
        {

        }elseif($user_status===3){
            $inn=Inn::find($request->inn_id);
            $inn->is_ok=true;
            $inn->password=Hash::make('123456789');
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
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.user_edit', ['user' => $user]);
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
        $user->update($request->all());
        return redirect(route('users.index'));
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
