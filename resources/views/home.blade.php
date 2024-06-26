@extends('layouts.app')

@section('content')

@if($expense_control)
<div class="row">
    <table class="table table-hover table-responsive-xs">
        <thead>
            <th>
                Limite
            </th>
            <th>
                Gasto
            </th>
            <th>
                Ahorro
            </th>
        </thead>
        <tbody>
            <td>
                <a href="{{route('expense_controls.show', ['expense_control' => $expense_control])}}" title="Detalle">
                    {{$expense_control->limit}}
                </a>
            </td>
            <td>
                <a href="{{route('expense_controls.show', ['expense_control' => $expense_control])}}" title="Detalle">
                    {{$expense_control->spent}}
                </a>
            </td>
            <td>
                <a href="{{route('expense_controls.show', ['expense_control' => $expense_control])}}" title="Detalle">
                    <div @if($expense_control->saving >= 0)
                       class = "text-primary"
                    @else 
                        class = "text-secondary"
                    @endif> 
                        {{$expense_control->saving}}
                    </div>
                </a>
            </td>
        </tbody>
    </table>
</div>
@endif
<div class="row">
    <div class="col-lg-4 col-xs-5">
        <a href="{{route('expense_details.create')}}">
            <div class="card">
                <div class="card-header">
                    Agregar gasto
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <img alt="wallet control" class="card-img" src="{{asset('image/money.png')}}">
                        </img>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
