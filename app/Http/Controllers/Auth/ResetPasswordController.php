<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function reset_pass()
    {
        return view('auth.reset_pass');
    }

    public function change_pass(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|between:8,20',
        ]);

        $password = Hash::make($request->password);
        $user= new \App\user;
        $count=User::where('name', $request->name)->where('email', $request->email)->count();
        $user=User::where('name', $request->name)->where('email', $request->email)->first();
        if($count===0)
        {
            return back();
        }
        $user->password=$password;
        $user->save();
        return redirect(route('login'));

        
    }
}
