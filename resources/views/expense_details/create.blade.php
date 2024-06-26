@extends('layouts.app')
@section('style', asset('css/StepForm.css'))
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="expense_detailsForm" method="POST" action="{{route('expense_details.store')}}">
        @method('POST')
        @csrf
        <strong class="p-1">Registrando Gasto</strong>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            <p class="p-2">Seleccione Tipo de Gasto</p>
            <table id="expense_types" class="table table-hover table-responsive-sm">
                <thead>
                <tr>
                    <th width=10%>Codigo</th>
                    <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                @foreach($expense_types as $expense_type)
                        <tr onclick="nextPrev(1,{{$loop->iteration}})">
                            <td width=10%>{{$expense_type->code}}</td>
                            <td >{{$expense_type->name}}</td>
                            <td style="display:none">{{$expense_type->id}}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            {{ $expense_types->links() }}
        </div>
        <div class="tab">
            <p id="tittle">Ingrese valor y descripcion</p>
            <p><input id="value" class="form-control form-control-lg" type=number placeholder="Valor..."  name="value"><p>
            <p><input id="description" class="form-control form-control-lg" type=text placeholder="Descripcion..." name="description"></p>
            <p><input type="hidden" id="expense_type_id" name="expense_type_id" value=""></p>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Tipo de gasto</button>
                <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Guardar</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>

@endsection
@section('script', asset('js/StepForm.js'))
