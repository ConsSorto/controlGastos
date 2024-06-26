@extends('layouts.app')
@section('content')
<div class="float-right m-4">
    <a href="{{route('expense_types.create')}}" title="Nuevo Gasto">
        <span class="fi-align-center btn btn-success oi oi-plus">
        </span>
    </a>
</div>
<table class="table table-hover table-responsive-xs">
    <thead>
        <tr>
            <th>
                Codigo
            </th>
            <th>
                Nombre
            </th>
            <th>
                Accion
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($expense_types as $expense_type)
        <tr>
            <td>
                <a href="{{route('expense_types.show', ['expense_type' => $expense_type])}}" title="Detalle">
                    {{$expense_type->code}}
                </a>
            </td>
            <td>
                <a href="{{route('expense_types.show', ['expense_type' => $expense_type])}}" title="Detalle">
                    {{$expense_type->name}}
                </a>
            </td>
            <td>
                <div class="row ">
                    <a href="{{route('expense_types.edit', ['expense_type' => $expense_type])}}" title="Editar">
                        <button class="btn btn-link" title="Editar" type="button">
                            <span class="oi oi-pencil">
                            </span>
                        </button>
                    </a>
                    <form action="{{route('expense_types.destroy', ['expense_type' => $expense_type])}}" method="POST">
                        @method('DELETE')
                            @csrf
                        <button class="btn btn-link" title="Eliminar" type="submit">
                            <span class="oi oi-circle-x">
                            </span>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$expense_types->links()}}
@endsection
