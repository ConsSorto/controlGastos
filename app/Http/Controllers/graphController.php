<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\expense_control;

class graphController extends Controller
{
    public function piechart($id)
    {
        $expense_control = expense_control::where('id', $id)
            ->where('user_id', auth()->id())->first();
            
        $alldata = DB::select('SELECT expense_types.name AS TipoGasto,' .
            'SUM(expense_control_details.value) AS Gasto ' .
            'FROM expense_control_details ' .
            'INNER JOIN expense_types ' .
            'ON expense_control_details.expense_type_id = expense_types.id ' .
            'WHERE expense_control_details.expense_control_id = ' .$id.
            ' GROUP BY TipoGasto');

        return view('graph.graph', compact('alldata', 'expense_control'));
    }

}
