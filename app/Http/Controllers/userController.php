<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if (auth()->user()->role == 0){
            $Users = User::paginate(5);
            return view('users.index', compact('Users'));
        }else{
            $User = User::find(auth()->id());
            return view('users.show', compact('User'));
        }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $User = User::find($id);

       return view('users.show', ['User'=> $User]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $User = User::find($id);

        return view('users.edit', ['User'=> $User]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Data = $request->validate(['name' => 'required',
           'email'=>[
               'required',
               Rule::unique('users')->ignore($id)
           ]], ['name.required' => 'Nombre del usuario es requerido',
            'email.required' => 'Email del usuario es requerido',
            'email.unique' => 'Email ya esta siendo usado']);

        $User = User::find($id);

        if ($Data['name'] <> $User->name)
            $User->name = $Data['name'];
        if ($Data['email'] <> $User->email)
            $User->email = $Data['email'];

        $User->save();

        return view('users.show', compact('User'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::find($id);
        $User->delete();

        return redirect()->route('welcome');
    }
}
