@extends('layouts.app')
@section('content')
<div class="float-right m-4">
    <a href="{{route('expense_controls.create')}}" title="Crear nuevo control">
        <span class="fi-align-center btn btn-success oi oi-plus">
        </span>
    </a>
</div>
<table class="table table-hover table-responsive-xs">
    <thead>
        <tr>
            <th>
                F. Inicial
            </th>
            <th>
                F. Final
            </th>
            <th>
                Activo
            </th>
            <th>
                Activar
            </th>
            <th>
                Limite
            </th>
            <th>
                Gasto
            </th>
            <th>
                Ahorro
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($expense_controls as $expense_control)
        <tr>
            <td>
                <a href="{{route('expense_controls.show', ['expense_control' => $expense_control])}}" title="Detalle">
                    {{$expense_control->initialDate->format('d/m/y')}}
                </a>
            </td>
            <td>
                <a href="{{route('expense_controls.show', ['expense_control' => $expense_control])}}" title="Detalle">
                    {{$expense_control->finalDate->format('d/m/y')}}
                </a>
            </td>
            <td>
                @if($expense_control->active == 1)
                    <span class="text-center oi oi-check">
                    </span>
                @endif
            </td>
            <td>
                <form action="{{route('expense_controls.activate', ['expense_control' => $expense_control])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <button class="btn btn-link" title="Activar" type="submit">
                        <span class="oi oi-circle-check">
                        </span>
                    </button>
                </form>
            </td>
            <td>
                {{$expense_control->limit}}
            </td>
            <td>
                {{$expense_control->spent}}
            </td>
            <td>
                <div @if($expense_control->saving >= 0)
                       class = "text-primary"
                    @else 
                        class = "text-secondary"
                    @endif> 
                    {{$expense_control->saving}}
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$expense_controls->links()}}
@endsection
