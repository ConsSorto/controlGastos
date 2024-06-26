<?php

namespace App\Http\Controllers;

use App\expense_control;
use App\expense_control_detail;
use App\expense_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class expense_detailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense_control = expense_control::where('user_id', auth()->id())->where('active', true)->first();

        if (!$expense_control)
            return redirect()->route('expense_controls.create')->with('warning',
                'No existe un control de gasto activo, tiene que crear uno');

        $expense_types = expense_type::where('user_id', auth()->id())->paginate(5);
        return view('expense_details.create', compact('expense_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['expense_type_id'=>'bail|required|exists:expense_types,id,user_id,'.auth()->id().'',
            'value'=>'required|numeric',
            'description' => 'sometimes'],
            ['expense_type_id.required'=>'Tipo de gasto requerido',
                'value.required'=>'Valor es requerido',
                'value.numeric'=>'Valor tiene que ser un numero']);

        $expense_control = expense_control::where('user_id', auth()->id())->where('active', true)->first();

        if (!$expense_control)
            return redirect()->route('expense_controls.create')->with('warning',
                'No existe un control de gasto activo, tiene que crear uno');

        $expense_control_detail = new expense_control_detail();
        $expense_control_detail->user_id = auth()->id();
        $expense_control_detail->expense_control_id = $expense_control->id;
        $expense_control_detail->expense_type_id = $data['expense_type_id'];
        $expense_control_detail->value = $data['value'];
        if (isset($data['description']))
            $expense_control_detail->description = $data['description'];

        $expense_control->spent = $expense_control->spent + $expense_control_detail->value;
        $expense_control->saving = $expense_control->limit - $expense_control->spent;

        DB::transaction(function() use ($expense_control_detail, $expense_control) {
            $expense_control->save();
            $expense_control_detail->save();
        });

        return redirect()->route('home')->with('notification',
            'Gasto agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
