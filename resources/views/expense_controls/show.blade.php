@extends('layouts.app')
@section('content')
<div class="flex-row">   
   <div class="btn-group" role="group">
    <a href="{{route('expense_controls.graph', $expense_control->id)}}" title="Ver grafico">
        <button class="btn btn-link" title="Eliminar" type="submit">
            <span class="oi oi-pie-chart">
            </span>
        </button>
    </a>
    <a href="{{route('expense_controls.edit', ['expense_control' => $expense_control])}}" title="Editar">
        <button class="btn btn-link" title="Editar" type="button">
            <span class="oi oi-pencil">
            </span>
        </button>
    </a>
        <form action="{{route('expense_controls.activate', ['expense_control' => $expense_control])}}" method="POST">
            @method('PUT')
            @csrf
            <button class="btn btn-link" title="Activar" type="submit">
                <span class="oi oi-circle-check">
                </span>
            </button>
        </form>
 </div>

  <div class="float-right">
        <form action="{{route('expense_controls.destroy', ['expense_control' => $expense_control])}}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-link" title="Eliminar" type="submit">
                <span class="oi oi-circle-x">
                </span>
            </button>
        </form>
    </div>
</div>
<div class="row">
<table class="table table-hover table-responsive-xs">
    <thead>
        <tr>
            <th>
                Fecha Inicial
            </th>
            <th>
                Fecha Final
            </th>
            <th>
                Activo
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{$expense_control->initialDate->format('d/m/y')}}
            </td>
            <td>
                {{$expense_control->finalDate->format('d/m/y')}}
            </td>
            <td>
                @if($expense_control->active == 1)
                    <span class="oi oi-check">
                    </span>
                @endif
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
            <tr>
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
        </tbody>
    </table>
</div>
<div class="row"> 
<strong class="p-3">
    Gastos
</strong>
<table class="table table-hover table-responsive-xs">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Fecha
            </th>
            <th>
                Valor
            </th>
            <th>
                Tipo
            </th>
            <th>
                Descripcion
            </th>
        </tr>
    </thead>
    <tbody>
        {{$expense_control_details = $expense_control->expense_control_details()->paginate(5)}}
        @foreach($expense_control_details as $expense_control_detail)
        <tr>
            <th>
                {{$loop->iteration}}
            </th>
            <td>
                {{$expense_control_detail->created_at->format('d/m/y h:i A')}}
            </td>
            <td>
                {{$expense_control_detail->value}}
            </td>
            <td>
                {{$expense_control_detail->expense_type->name}}
            </td>
            <td>
                {{$expense_control_detail->description}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$expense_control_details->links()}}
  </div>
@endsection
