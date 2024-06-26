<?php

namespace App\Http\Controllers;

use App\expense_type;
use Illuminate\Http\Request;

class expense_typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $expense_types = expense_type::where('user_id', auth()->id())
            ->orderBy('name', 'desc')
            ->paginate(5);

        return view('expense_types.index', compact('expense_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|unique:expense_types,code,NULL,id,user_id,' . auth()->id(),
            'name' => 'required|unique:expense_types,name,NULL,id,user_id,' . auth()->id()],
            ['code.required' => 'El codigo es requerido',
                'code.unique' => 'El codigo ya esta siendo usado',
                'name.required' => 'El nombre es requerido',
                'name.unique' => 'El nombre ya esta siendo usado']);

        $expense_type = new expense_type();
        $expense_type->code = $data['code'];
        $expense_type->name = $data['name'];
        $expense_type->user_id = auth()->id();
        $expense_type->save();

        return redirect()->route('expense_types.show', compact('expense_type'))
            ->with('notification', 'Tipo de gasto fue creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense_type = expense_type::where('id', $id)
            ->where('user_id', auth()->id())->first();
        return view('expense_types.show', compact('expense_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense_type = expense_type::where('id', $id)
            ->where('user_id', auth()->id())->first();
        return view('expense_types.edit', compact('expense_type'));
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
        $data = $request->validate([
            'code' => 'required|unique:expense_types,code,'.$id.',id,user_id,' . auth()->id(),
            'name' => 'required|unique:expense_types,name,'.$id.',id,user_id,' . auth()->id()],
            ['code.required' => 'El codigo es requerido',
                'code.unique' => 'El codigo ya esta siendo usado',
                'name.required' => 'El nombre es requerido',
                'name.unique' => 'El nombre ya esta siendo usado']);

        $expense_type = expense_type::where('id', $id)
            ->where('user_id', auth()->id())->first();
        $expense_type->code = $data['code'];
        $expense_type->name = $data['name'];
        $expense_type->save();

        return redirect()->route('expense_types.show', compact('expense_type'))
            ->with('notification', 'Tipo de gasto fue actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense_type = expense_type::where('id', $id)
            ->where('user_id', auth()->id())->first();
        $expense_type->delete();

        return redirect()->route('expense_types.index')->with('notification', 'Tipo de gasto borrado');
    }
}
