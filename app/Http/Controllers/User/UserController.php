<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios=User::all();
        return view("users.users")->with('users',$usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );

        // dd($request->get('password'));
        // $usuario=New User;
        // $usuario->name=$request->get('name');
        // $usuario->name=$request->get('email');
        // $usuario->name=$request->get('username');
        // $usuario->name=$request->get('password');
        // $usuario->save();
        // return redirect('/users')->with(['success' => 'Usuario registrado correctamente']);
        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);

        return redirect('/user')->with(['success' => 'Usuario registrado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email'=>$request->email,
            'username'=>$request->username,
        ]);

        return redirect('/user')->with(['success' => 'Usuario Actualizado correctamente']);
    }

    public function state(User $user, $state)
    {

        if ($state=='disabled') {
            $status=0;
            $message="Inhabilitado";
        }else{
            $status=1;
            $message="Habilitado";
        }
        // dd($user);
        // $user->update([
        //     'status' => $status,
        // ]);

        $user=User::findOrFail($user->id);
        // dd($user);
        $user->status=$status;
        $user->save();


        return redirect('/user')->with(['success' => 'Usuario '.$message.' correctamente']);

    }

    public  function changepass(Request $request,User $user)
    {
        
        $request->validate(
            [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
            
        );

        $user=User::findOrFail($user->id);
        // dd($user);
        $user->password=$request['password'];
        $user->save();

        return redirect('/user')->with(['success' => 'Contraseña Actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
