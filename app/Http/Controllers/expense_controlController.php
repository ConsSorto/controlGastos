<?php

namespace App\Http\Controllers;

use App\expense_control;
use Illuminate\Http\Request;

class expense_controlController extends Controller
{
    public function __construct(Request $request)
    {

        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware(function ($request, $next) {
            $this->verifyActive();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $expense_controls = expense_control::where('user_id', auth()->id())
       ->orderBy('active', 'desc')->orderBy('initialDate')->paginate(5);
       return view('expense_controls.index', compact('expense_controls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense_controls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['initialDate' =>'bail|required|date|before:'.$request->finalDate,
            'finalDate' =>'required|date|after:'.$request->initialDate,
            'limit' =>'numeric|min:0']);
        $expense_control = new expense_control();

        $expense_control->user_id = auth()->id();
        $expense_control->initialDate = $data['initialDate'];
        $expense_control->finalDate = $data['finalDate'];
        $expense_control->limit = $data['limit'];
        $expense_control->saving = $data['limit'];
        $expense_control->save();

        return redirect()->route('expense_controls.show', compact('expense_control'))
            ->with('notification', 'Control de gasto fue creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense_control = expense_control::where('id', $id)
            ->where('user_id', auth()->id())->first();
        return view('expense_controls.show', compact('expense_control'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense_control = expense_control::where('id', $id)
            ->where('user_id', auth()->id())->first();
        return view('expense_controls.edit', compact('expense_control'));
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
        $data = $request->validate(['initialDate' =>'bail|required|date|before:'.$request->finalDate,
        'finalDate' =>'required|date|after:'.$request->initialDate,
        'limit' =>'numeric|min:0']);

        $expense_control = expense_control::where('id', $id)
            ->where('user_id', auth()->id())->first();
        $expense_control->initialDate = $data['initialDate'];
        $expense_control->finalDate = $data['finalDate'];
        $expense_control->limit = $data['limit'];
        $expense_control->saving = $expense_control->limit - $expense_control->spent;
        $expense_control->save();

        return redirect()->route('expense_controls.show', $expense_control)->with('notification',
            'Control de gastos actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense_control = expense_control::where('id', $id)
            ->where('user_id', auth()->id())->first();
        $expense_control->delete();

        return redirect()->route('expense_controls.index')->with('notification', 'Control de gasto borrado');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($id)
    {
        $validatingExpenseControl = expense_control::where('id', $id)
            ->where('finalDate', '>=', now()->format('Y-m-d'))
            ->where('user_id', auth()->id())->first();

        if (!$validatingExpenseControl)
            return redirect()->back()->with('warning',
                'NO SE PUEDE ACTIVAR su fecha final es menor a la fecha actual');

        expense_control::where('active', true)->update(['active' => false]);

        $expense_control = expense_control::where('id', $id)
            ->where('user_id', auth()->id())->first();
        $expense_control->active = true;
        $expense_control->save();

       return redirect()->route('expense_controls.show', $expense_control)->with('notification', 'Control de gasto Activado');
    }

    public static function verifyActive()
    {
        if (expense_control::where('user_id', auth()->id())->count() == 0)
            return;

        expense_control::where('finalDate', '<', now()->format('Y-m-d'))
           ->where('active', true)
           ->where('user_id', auth()->id())
           ->update(array('active' => false));

        $expense_control = expense_control::where('finalDate', '=>', now())
            ->where('active', true)
            ->where('user_id', auth()->id());

        if (empty($expense_control))
          return redirect()->back()->with('notification', 'Los controles de gasto con fecha final "
            ."menor a la fecha actual fueron desactivados');

    }

 
}
