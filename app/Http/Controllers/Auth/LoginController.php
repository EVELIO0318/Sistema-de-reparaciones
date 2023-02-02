<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        $credentials = request()->validate([
            "email" => ["string","max:191","required", function(){
                return User::where("email", request()->email)->orWhere("username", request()->email)->first();
            }],
            "password" => "max:191|required",
        ]);

        $user = User::where("email", request()->email)->orWhere("username", request()->email)->first();

        if($user){
            //si lo encuentra, lo editamos con los datos que trajo para validar todo junto
            $credentials["status"] = 1;
            $credentials["email"] = $user->email;
            $credentials["username"] = $user->username;
    

            //aqui validamos
            if(Auth::attempt($credentials)){

                //creamos la sesion 
                request()->session()->regenerate();
                
                //redireccionamos
                return redirect()->intended("admin");
            }

            $message = $user->status ? "Las credenciales no son validas." : "Usuario inactivo";
        }else{
            $message = "Las credenciales no son validas";
        }

        return back()->withErrors(["email" => $message])->withInput(request(["email"]));
    }
}
