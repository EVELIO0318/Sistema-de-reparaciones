<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dashboard=[];
        $users=User::all()->count();
        $customer=Customer::all()->count();
        $pending=Order::where('status',0)->count();
        $ready=Order::where('status',1)->count();

        array_push($dashboard,$users,$customer,$pending,$ready);
        // dd($dashboard);
        return view('home')->with("data",$dashboard);
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect("/");
    }
}
