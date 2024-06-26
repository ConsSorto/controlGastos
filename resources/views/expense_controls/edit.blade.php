@extends('layouts.app')
@section('content')
    <form action="{{route('expense_controls.update', $expense_control)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="initialDate">Fecha Inicial</label>
            <input class="form-control" type="date" name="initialDate" required  value="{{old('initialDate', $expense_control->initialDate->format('Y-m-d'))}}">
            @if ($errors->has('initialDate'))
                <div class="text-danger">
                    @foreach ($errors->get('initialDate') as $message)
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="finalDate">Fecha Final</label>
            <input class="form-control" type="date" name="finalDate" required value="{{old('finalDate', $expense_control->finalDate->format('Y-m-d'))}}">
            @if ($errors->has('finalDate'))
                <div class="text-danger">
                    @foreach ($errors->get('finalDate') as $message)
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="limit">Limite</label>
            <input class="form-control" type="number" name="limit" min="0" value="{{old('limit', $expense_control->limit)}}">
        </div>
        @if ($errors->has('limit'))
            <div class="text-danger">
                @foreach ($errors->get('limit') as $message)
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