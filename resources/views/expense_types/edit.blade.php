@extends('layouts.app')
@section('content')
    <form action="{{route('expense_types.update', $expense_type)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Codigo</label>
            <input class="form-control" type="text" name="code" value="{{old('code', $expense_type->code)}} ">
            @if ($errors->has('code'))
                <div class="text-danger">
                    @foreach ($errors->get('code') as $message)
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Nombre</label>
            <input class="form-control" type="text" name="name" value="{{old('name', $expense_type->code)}}">
        </div>
        @if ($errors->has('name'))
            <div class="text-danger">
                @foreach ($errors->get('name') as $message)
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                @endforeach
            </div>
        @endif
        <div class="form-group">
            <button type="submit" class="btn btn-success" title="Actualizar">Actualizar
                <span class="oi oi-circle-check"></span>
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-info">Cancelar</a>
        </div>
    </form>
@endsection