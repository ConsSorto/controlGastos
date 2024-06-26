@extends('layouts.app')
@section('content')
<div class="row">
    <table class="table table-hover table-responsive-xs">
        <thead>
            <tr>
                <th>
                    Codigo
                </th>
                <th>
                    Nombre
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{$expense_type->name}}
                </td>
                <td>
                    {{$expense_type->code}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <table class="table table-hover table-responsive-xs">
        <thead>
            <tr>
                <th>
                    Creado
                </th>
                <th>
                    Actualizado
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{$expense_type->created_at->format('d/m/Y')}}
                </td>
                <td>
                    {{$expense_type->updated_at->format('d/m/Y')}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row d-flex justify-content-center">
    <a href="{{route('expense_types.edit', ['expense_type' => $expense_type])}}" title="Editar">
        <button class="btn btn-primary mr-1" title="Editar" type="button">
            Editar
            <span class="oi oi-pencil"> </span>            
        </button>
    </a>
    <form action="{{route('expense_types.destroy', $expense_type)}}" method="POST">
        @method('DELETE')
                        @csrf
        <button class="btn btn-secondary mr-1" title="Eliminar" type="submit">
            Eliminar
            <span class="oi oi-circle-x">
            </span>
        </button>
    </form>
</div>
@endsection
