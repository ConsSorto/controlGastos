@extends('layouts.app')
@section('content')
    <form action="{{route('expense_types.store')}}" method="POST">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="name">Codigo</label>
            <input class="form-control" type="text" name="code" value="{{old('code')}} ">
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
            <input class="form-control" type="text" name="name" value="{{old('name')}}">
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
            <button type="submit" class="btn btn-success" title="Guardar">Guardar
                <span class="oi oi-circle-check"></span>
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-info">Cancelar</a>
        </div>
    </form>
@endsection