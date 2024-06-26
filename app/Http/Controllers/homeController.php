<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expense_control;

class homeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        expense_controlController::verifyActive();

        $expense_control = expense_control::where('user_id', auth()->id())->where('active', true)->first();
        return view('home', compact('expense_control'));
    }
}
