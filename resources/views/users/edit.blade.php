@extends('layouts.app')
@section('content')
    <form action="{{route('user.update', $User)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input class="form-control" type="text" name="name" value="{{old('name',$User->name)}} ">
            @if ($errors->has('name'))
                <div class="text-danger">
                    @foreach ($errors->get('name') as $message)
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" value="{{old('email',$User->email)}}">
        </div>
        @if ($errors->has('email'))
            <div class="text-danger">
                @foreach ($errors->get('email') as $message)
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